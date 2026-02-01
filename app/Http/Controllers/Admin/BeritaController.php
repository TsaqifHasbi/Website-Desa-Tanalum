<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with('kategori', 'author');

        // Search
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $beritas = $query->latest()->paginate(10);
        $kategoris = KategoriBerita::active()->get();

        return view('admin.berita.index', compact('beritas', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriBerita::active()->get();
        $berita = null;

        return view('admin.berita.form', compact('kategoris', 'berita'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string|max:500',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);
        $count = Berita::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        // Set author
        $validated['user_id'] = Auth::id();

        // Handle featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Handle published_at
        if ($validated['status'] === 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Handle image
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        // Handle tags
        if ($validated['tags']) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $kategoris = KategoriBerita::active()->get();

        return view('admin.berita.form', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string|max:500',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        // Update slug if title changed
        if ($berita->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']);
            $count = Berita::where('slug', 'like', $validated['slug'] . '%')
                ->where('id', '!=', $berita->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        // Handle featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Handle published_at
        if ($validated['status'] === 'published' && !$berita->published_at && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Handle image
        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        // Handle tags
        if ($validated['tags']) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar_utama) {
            Storage::disk('public')->delete($berita->gambar_utama);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    // Kategori Management
    public function kategori()
    {
        $kategoris = KategoriBerita::withCount('berita')->paginate(10);

        return view('admin.berita.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        KategoriBerita::create($validated);

        return redirect()->route('admin.berita.kategori')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, KategoriBerita $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        if ($kategori->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $kategori->update($validated);

        return redirect()->route('admin.berita.kategori')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriBerita $kategori)
    {
        if ($kategori->berita()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki berita terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.berita.kategori')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
