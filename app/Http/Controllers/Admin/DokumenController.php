<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPpid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DokumenPpid::query();

        // Search
        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $dokumens = $query->latest()->paginate(15);

        // Stats
        $stats = [
            'total' => DokumenPpid::count(),
            'berkala' => DokumenPpid::where('jenis', 'berkala')->count(),
            'serta_merta' => DokumenPpid::where('jenis', 'serta_merta')->count(),
            'setiap_saat' => DokumenPpid::where('jenis', 'setiap_saat')->count(),
        ];

        return view('admin.dokumen.index', compact('dokumens', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokumen.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:berkala,serta_merta,setiap_saat',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'nomor' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'is_active' => 'boolean',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . Str::random(5),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'nomor_dokumen' => $validated['nomor'] ?? null,
            'tanggal_dokumen' => $validated['tanggal'] ?? null,
            'tahun' => $validated['tanggal'] ? date('Y', strtotime($validated['tanggal'])) : date('Y'),
            'is_active' => $request->has('is_active'),
            'download_count' => 0,
            'view_count' => 0,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('ppid', 'public');
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        DokumenPpid::create($data);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dokumen = DokumenPpid::findOrFail($id);
        return view('admin.dokumen.form', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dokumen = DokumenPpid::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:berkala,serta_merta,setiap_saat',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'nomor' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'is_active' => 'boolean',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'nomor_dokumen' => $validated['nomor'] ?? null,
            'tanggal_dokumen' => $validated['tanggal'] ?? null,
            'tahun' => $validated['tanggal'] ? date('Y', strtotime($validated['tanggal'])) : $dokumen->tahun,
            'is_active' => $request->has('is_active'),
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($dokumen->file_path) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('ppid', 'public');
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        $dokumen->update($data);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokumen = DokumenPpid::findOrFail($id);

        // Delete file
        if ($dokumen->file_path) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Format file size to human readable
     */
    private function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
