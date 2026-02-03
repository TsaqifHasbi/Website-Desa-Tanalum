<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisatas = Wisata::latest()->paginate(10);
        return view('admin.wisata.index', compact('wisatas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wisata.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_buka' => 'nullable|string|max:100',
            'jam_tutup' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'fasilitas' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']) . '-' . Str::random(5);
        $validated['is_active'] = $request->has('is_active');

        // Handle fasilitas as array
        if ($request->filled('fasilitas')) {
            $validated['fasilitas'] = array_map('trim', explode(',', $request->fasilitas));
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $validated['gambar_utama'] = $request->file('gambar')->store('wisata', 'public');
            unset($validated['gambar']);
        }

        // Handle Koordinat (Lat, Lng)
        if ($request->filled('koordinat')) {
            $coords = explode(',', $request->koordinat);
            if (count($coords) === 2) {
                $validated['latitude'] = trim($coords[0]);
                $validated['longitude'] = trim($coords[1]);
            }
            unset($validated['koordinat']);
        }

        Wisata::create($validated);

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        return view('admin.wisata.form', compact('wisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_buka' => 'nullable|string|max:100',
            'jam_tutup' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'fasilitas' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Handle fasilitas as array
        if ($request->filled('fasilitas')) {
            $validated['fasilitas'] = array_map('trim', explode(',', $request->fasilitas));
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($wisata->gambar_utama) {
                Storage::disk('public')->delete($wisata->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar')->store('wisata', 'public');
            unset($validated['gambar']);
        }

        // Handle Koordinat (Lat, Lng)
        if ($request->filled('koordinat')) {
            $coords = explode(',', $request->koordinat);
            if (count($coords) === 2) {
                $validated['latitude'] = trim($coords[0]);
                $validated['longitude'] = trim($coords[1]);
            }
            unset($validated['koordinat']);
        }

        $wisata->update($validated);

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        // Delete gambar
        if ($wisata->gambar_utama) {
            Storage::disk('public')->delete($wisata->gambar_utama);
        }

        $wisata->delete();

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil dihapus.');
    }
}
