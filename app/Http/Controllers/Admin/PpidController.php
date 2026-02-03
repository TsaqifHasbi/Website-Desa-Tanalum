<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPpid;
use App\Models\KategoriPpid;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpidController extends Controller
{
    // Dokumen PPID
    public function index(Request $request)
    {
        $query = DokumenPpid::with('kategori');

        // Search
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $dokumens = $query->latest()->paginate(10);
        $kategoris = KategoriPpid::active()->get();

        return view('admin.ppid.index', compact('dokumens', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriPpid::active()->ordered()->get();

        return view('admin.ppid.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategori_ppid,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'tahun' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'nomor_dokumen' => 'nullable|string|max:100',
            'tanggal_dokumen' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);
        $count = DokumenPpid::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Handle boolean
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle file upload
        $file = $request->file('file');
        $validated['file_path'] = $file->store('ppid', 'public');
        $validated['file_size'] = $file->getSize();
        $validated['file_type'] = $file->getClientMimeType();

        unset($validated['file']);

        DokumenPpid::create($validated);

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Dokumen PPID berhasil ditambahkan.');
    }

    public function edit(DokumenPpid $dokumen)
    {
        $kategoris = KategoriPpid::active()->ordered()->get();

        return view('admin.ppid.edit', compact('dokumen', 'kategoris'));
    }

    public function update(Request $request, DokumenPpid $dokumen)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategori_ppid,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'tahun' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'nomor_dokumen' => 'nullable|string|max:100',
            'tanggal_dokumen' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if title changed
        if ($dokumen->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']);
            $count = DokumenPpid::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $dokumen->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle boolean
        $validated['is_active'] = $request->boolean('is_active');

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($dokumen->file_path) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $file = $request->file('file');
            $validated['file_path'] = $file->store('ppid', 'public');
            $validated['file_size'] = $file->getSize();
            $validated['file_type'] = $file->getClientMimeType();
        }

        unset($validated['file']);

        $dokumen->update($validated);

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Dokumen PPID berhasil diperbarui.');
    }

    public function destroy(DokumenPpid $dokumen)
    {
        if ($dokumen->file_path) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('admin.ppid.index')
            ->with('success', 'Dokumen PPID berhasil dihapus.');
    }

    // Kategori PPID
    public function kategori()
    {
        $kategoris = KategoriPpid::withCount('dokumen')->ordered()->paginate(10);

        return view('admin.ppid.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:berkala,serta_merta,setiap_saat',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        KategoriPpid::create($validated);

        return redirect()->route('admin.ppid.kategori')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, KategoriPpid $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:berkala,serta_merta,setiap_saat',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($kategori->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $kategori->update($validated);

        return redirect()->route('admin.ppid.kategori')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriPpid $kategori)
    {
        if ($kategori->dokumen()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki dokumen terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.ppid.kategori')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // Permohonan Informasi
    public function permohonan(Request $request)
    {
        $query = PermohonanInformasi::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permohonans = $query->latest()->paginate(10);

        return view('admin.ppid.permohonan', compact('permohonans'));
    }

    public function permohonanShow(PermohonanInformasi $permohonan)
    {
        return view('admin.ppid.permohonan-detail', compact('permohonan'));
    }

    public function permohonanUpdate(Request $request, PermohonanInformasi $permohonan)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string',
            'dokumen_balasan' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        // Map 'menunggu' to 'pending' if your DB uses 'pending' (check migration)
        // Migration says: pending, diproses, selesai, ditolak
        if ($validated['status'] === 'menunggu') {
            $validated['status'] = 'pending';
        }

        if ($validated['status'] === 'selesai') {
            $validated['tanggal_selesai'] = now();
        }

        // Handle response file
        if ($request->hasFile('dokumen_balasan')) {
            if ($permohonan->file_balasan) {
                Storage::disk('public')->delete($permohonan->file_balasan);
            }
            $validated['file_balasan'] = $request->file('dokumen_balasan')->store('ppid/jawaban', 'public');
        }

        $permohonan->update($validated);

        return redirect()->route('admin.ppid.permohonan')
            ->with('success', 'Status permohonan berhasil diperbarui.');
    }
}
