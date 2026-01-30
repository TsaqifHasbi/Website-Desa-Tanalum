<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::ordered()->paginate(10);

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'link' => 'nullable|url',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle boolean
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('slider', 'public');
        }

        Slider::create($validated);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'link' => 'nullable|url',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle boolean
        $validated['is_active'] = $request->boolean('is_active');

        // Handle image
        if ($request->hasFile('gambar')) {
            if ($slider->gambar) {
                Storage::disk('public')->delete($slider->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('slider', 'public');
        }

        $slider->update($validated);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->gambar) {
            Storage::disk('public')->delete($slider->gambar);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:sliders,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Slider::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['message' => 'Urutan slider berhasil diperbarui.']);
    }
}
