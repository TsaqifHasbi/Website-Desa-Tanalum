<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WisataDesa;
use App\Models\PotensiDesa;
use App\Models\KategoriPotensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    // Wisata
    public function wisataIndex()
    {
        $wisatas = WisataDesa::latest()->paginate(10);

        return view('admin.wisata.index', compact('wisatas'));
    }

    public function wisataCreate()
    {
        return view('admin.wisata.form');
    }

    public function wisataStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'koordinat_lat' => 'nullable|numeric',
            'koordinat_lng' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
            'jam_buka' => 'nullable|string|max:100',
            'jam_tutup' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama']);
        $count = WisataDesa::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle main image
        if ($request->hasFile('gambar')) {
            $validated['gambar_utama'] = $request->file('gambar')->store('wisata', 'public');
            unset($validated['gambar']);
        }

        // Handle gallery
        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('wisata', 'public');
            }
        }
        $validated['galeri'] = $galeri;

        // Handle fasilitas as array
        if ($validated['fasilitas']) {
            $validated['fasilitas'] = array_map('trim', explode(',', $validated['fasilitas']));
        }

        WisataDesa::create($validated);

        return redirect()->route('admin.potensi.wisata')
            ->with('success', 'Wisata desa berhasil ditambahkan.');
    }

    public function wisataEdit(WisataDesa $wisata)
    {
        return view('admin.wisata.form', compact('wisata'));
    }

    public function wisataUpdate(Request $request, WisataDesa $wisata)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'koordinat_lat' => 'nullable|numeric',
            'koordinat_lng' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
            'jam_buka' => 'nullable|string|max:100',
            'jam_tutup' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if name changed
        if ($wisata->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
            $count = WisataDesa::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $wisata->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        // Handle main image
        if ($request->hasFile('gambar')) {
            if ($wisata->gambar_utama) {
                Storage::disk('public')->delete($wisata->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar')->store('wisata', 'public');
            unset($validated['gambar']);
        }

        // Handle gallery
        if ($request->hasFile('galeri')) {
            // Delete old gallery
            if ($wisata->galeri) {
                foreach ($wisata->galeri as $img) {
                    Storage::disk('public')->delete($img);
                }
            }

            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('wisata', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        // Handle fasilitas as array
        if ($validated['fasilitas']) {
            $validated['fasilitas'] = array_map('trim', explode(',', $validated['fasilitas']));
        }

        $wisata->update($validated);

        return redirect()->route('admin.potensi.wisata')
            ->with('success', 'Wisata desa berhasil diperbarui.');
    }

    public function wisataDestroy(WisataDesa $wisata)
    {
        if ($wisata->gambar_utama) {
            Storage::disk('public')->delete($wisata->gambar_utama);
        }

        if ($wisata->galeri) {
            foreach ($wisata->galeri as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $wisata->delete();

        return redirect()->route('admin.potensi.wisata')
            ->with('success', 'Wisata desa berhasil dihapus.');
    }

    // Potensi
    public function potensiIndex()
    {
        $potensis = PotensiDesa::with('kategori')->latest()->paginate(10);
        $kategoris = KategoriPotensi::active()->get();

        return view('admin.potensi.index', compact('potensis', 'kategoris'));
    }

    public function potensiCreate()
    {
        $kategoris = KategoriPotensi::active()->get();

        return view('admin.potensi.create', compact('kategoris'));
    }

    public function potensiStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_potensi,id',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama']);
        $count = PotensiDesa::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image
        if ($request->hasFile('gambar')) {
            $validated['gambar_utama'] = $request->file('gambar')->store('potensi', 'public');
            unset($validated['gambar']);
        }

        PotensiDesa::create($validated);

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function potensiEdit(PotensiDesa $potensi)
    {
        $kategoris = KategoriPotensi::active()->get();

        return view('admin.potensi.edit', compact('potensi', 'kategoris'));
    }

    public function potensiUpdate(Request $request, PotensiDesa $potensi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_potensi,id',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if name changed
        if ($potensi->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
            $count = PotensiDesa::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $potensi->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        // Handle image
        if ($request->hasFile('gambar')) {
            if ($potensi->gambar_utama) {
                Storage::disk('public')->delete($potensi->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar')->store('potensi', 'public');
            unset($validated['gambar']);
        }

        $potensi->update($validated);

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function potensiDestroy(PotensiDesa $potensi)
    {
        if ($potensi->gambar_utama) {
            Storage::disk('public')->delete($potensi->gambar_utama);
        }

        $potensi->delete();

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil dihapus.');
    }

    // Kategori Potensi
    public function kategori()
    {
        $kategoris = KategoriPotensi::withCount('potensi')->paginate(10);

        return view('admin.potensi.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        KategoriPotensi::create($validated);

        return redirect()->route('admin.potensi.kategori')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, KategoriPotensi $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        if ($kategori->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $kategori->update($validated);

        return redirect()->route('admin.potensi.kategori')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriPotensi $kategori)
    {
        if ($kategori->potensi()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki potensi terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.potensi.kategori')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
