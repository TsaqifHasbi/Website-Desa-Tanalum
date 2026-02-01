<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::with('kategori');

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $galeris = $query->ordered()->paginate(12);
        $kategoris = KategoriGaleri::active()->get();

        return view('admin.galeri.index', compact('galeris', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriGaleri::active()->get();
        $galeri = null;

        return view('admin.galeri.form', compact('kategoris', 'galeri'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategori_galeri,id',
            'tipe' => 'required|in:foto,video',
            'file' => 'required_if:tipe,foto|nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video_url' => 'required_if:tipe,video|nullable|url',
            'urutan' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);
        $count = Galeri::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle file upload
        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('galeri', 'public');
        }

        unset($validated['file']);

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $kategoris = KategoriGaleri::active()->get();

        return view('admin.galeri.form', compact('galeri', 'kategoris'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategori_galeri,id',
            'tipe' => 'required|in:foto,video',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video_url' => 'nullable|url',
            'urutan' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if title changed
        if ($galeri->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']);
            $count = Galeri::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $galeri->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($galeri->file_path) {
                Storage::disk('public')->delete($galeri->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('galeri', 'public');
        }

        unset($validated['file']);

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->file_path) {
            Storage::disk('public')->delete($galeri->file_path);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    // Kategori Management
    public function kategori()
    {
        $kategoris = KategoriGaleri::withCount('galeri')->paginate(10);

        return view('admin.galeri.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        KategoriGaleri::create($validated);

        return redirect()->route('admin.galeri.kategori')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, KategoriGaleri $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($kategori->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $kategori->update($validated);

        return redirect()->route('admin.galeri.kategori')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriGaleri $kategori)
    {
        if ($kategori->galeri()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki galeri terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.galeri.kategori')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
