<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukUmkm;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = ProdukUmkm::with('kategori');

        // Search
        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $produks = $query->latest()->paginate(10);
        $kategoris = KategoriProduk::active()->get();

        return view('admin.produk.index', compact('produks', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriProduk::active()->get();
        $produk = null;

        return view('admin.produk.form', compact('kategoris', 'produk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_produk,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
            'stok' => 'nullable|integer|min:0',
            'pemilik' => 'nullable|string|max:255',
            'kontak_pemilik' => 'nullable|string|max:255',
            'alamat_pemilik' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama']);
        $count = ProdukUmkm::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle main image
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('produk', 'public');
        }

        // Handle gallery images
        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('produk', 'public');
            }
        }
        $validated['galeri'] = $galeri;

        ProdukUmkm::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(ProdukUmkm $produk)
    {
        $kategoris = KategoriProduk::active()->get();

        return view('admin.produk.form', compact('produk', 'kategoris'));
    }

    public function update(Request $request, ProdukUmkm $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_produk,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
            'stok' => 'nullable|integer|min:0',
            'pemilik' => 'nullable|string|max:255',
            'kontak_pemilik' => 'nullable|string|max:255',
            'alamat_pemilik' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if name changed
        if ($produk->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
            $count = ProdukUmkm::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $produk->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle boolean
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        // Handle main image
        if ($request->hasFile('gambar_utama')) {
            if ($produk->gambar_utama) {
                Storage::disk('public')->delete($produk->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('produk', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('galeri')) {
            // Delete old images
            if ($produk->galeri) {
                foreach ($produk->galeri as $img) {
                    Storage::disk('public')->delete($img);
                }
            }

            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('produk', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(ProdukUmkm $produk)
    {
        if ($produk->gambar_utama) {
            Storage::disk('public')->delete($produk->gambar_utama);
        }

        if ($produk->galeri) {
            foreach ($produk->galeri as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // Kategori Management
    public function kategori()
    {
        $kategoris = KategoriProduk::withCount('produk')->paginate(10);

        return view('admin.produk.kategori', compact('kategoris'));
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

        KategoriProduk::create($validated);

        return redirect()->route('admin.produk.kategori')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, KategoriProduk $kategori)
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

        return redirect()->route('admin.produk.kategori')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriProduk $kategori)
    {
        if ($kategori->produk()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki produk terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.produk.kategori')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
