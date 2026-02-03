<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CeritaRakyat;
use App\Models\KepalaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SejarahDesaController extends Controller
{
    /**
     * Display sejarah desa admin page.
     */
    public function index()
    {
        $ceritaRakyat = CeritaRakyat::ordered()->get();
        $kepalaDesa = KepalaDesa::ordered()->get();

        return view('admin.sejarah-desa.index', compact('ceritaRakyat', 'kepalaDesa'));
    }

    // ================================
    // CERITA RAKYAT METHODS
    // ================================

    /**
     * Show create form for cerita rakyat.
     */
    public function ceritaCreate()
    {
        return view('admin.sejarah-desa.cerita.create');
    }

    /**
     * Store cerita rakyat.
     */
    public function ceritaStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('sejarah/cerita', 'public');
        }

        CeritaRakyat::create($validated);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Cerita rakyat berhasil ditambahkan.');
    }

    /**
     * Show edit form for cerita rakyat.
     */
    public function ceritaEdit(CeritaRakyat $cerita)
    {
        return view('admin.sejarah-desa.cerita.edit', compact('cerita'));
    }

    /**
     * Update cerita rakyat.
     */
    public function ceritaUpdate(Request $request, CeritaRakyat $cerita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('gambar_utama')) {
            // Delete old image
            if ($cerita->gambar_utama) {
                Storage::disk('public')->delete($cerita->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('sejarah/cerita', 'public');
        }

        $cerita->update($validated);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Cerita rakyat berhasil diperbarui.');
    }

    /**
     * Delete cerita rakyat.
     */
    public function ceritaDestroy(CeritaRakyat $cerita)
    {
        if ($cerita->gambar_utama) {
            Storage::disk('public')->delete($cerita->gambar_utama);
        }

        $cerita->delete();

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Cerita rakyat berhasil dihapus.');
    }

    /**
     * Upload image for WYSIWYG editor.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        $path = $request->file('file')->store('sejarah/konten', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }

    // ================================
    // KEPALA DESA METHODS
    // ================================

    /**
     * Show create form for kepala desa.
     */
    public function kepalaCreate()
    {
        return view('admin.sejarah-desa.kepala.create');
    }

    /**
     * Store kepala desa.
     */
    public function kepalaStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tahun_mulai' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'tahun_selesai' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:tahun_mulai',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('sejarah/kepala-desa', 'public');
        }

        KepalaDesa::create($validated);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data kepala desa berhasil ditambahkan.');
    }

    /**
     * Show edit form for kepala desa.
     */
    public function kepalaEdit(KepalaDesa $kepala)
    {
        return view('admin.sejarah-desa.kepala.edit', compact('kepala'));
    }

    /**
     * Update kepala desa.
     */
    public function kepalaUpdate(Request $request, KepalaDesa $kepala)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tahun_mulai' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'tahun_selesai' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:tahun_mulai',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($kepala->foto) {
                Storage::disk('public')->delete($kepala->foto);
            }
            $validated['foto'] = $request->file('foto')->store('sejarah/kepala-desa', 'public');
        }

        $kepala->update($validated);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data kepala desa berhasil diperbarui.');
    }

    /**
     * Delete kepala desa.
     */
    public function kepalaDestroy(KepalaDesa $kepala)
    {
        if ($kepala->foto) {
            Storage::disk('public')->delete($kepala->foto);
        }

        $kepala->delete();

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data kepala desa berhasil dihapus.');
    }
}
