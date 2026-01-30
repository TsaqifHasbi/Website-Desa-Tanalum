<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aparatur;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AparaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aparatur::query();

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $aparaturs = $query->orderBy('jenis')
            ->orderBy('urutan')
            ->paginate(20);

        return view('admin.aparatur.index', compact('aparaturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aparatur.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'jenis' => 'required|in:perangkat,bpd,lpm,pkk,karang_taruna,lembaga_lain',
            'pendidikan' => 'nullable|string|max:100',
            'masa_jabatan' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'tugas_pokok' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        // Handle photo upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        Aparatur::create($validated);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aparatur $aparatur)
    {
        return view('admin.aparatur.form', compact('aparatur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aparatur $aparatur)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'jenis' => 'required|in:perangkat,bpd,lpm,pkk,karang_taruna,lembaga_lain',
            'pendidikan' => 'nullable|string|max:100',
            'masa_jabatan' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'tugas_pokok' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        // Handle photo upload
        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($aparatur->foto) {
                Storage::disk('public')->delete($aparatur->foto);
            }
            $validated['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        $aparatur->update($validated);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aparatur $aparatur)
    {
        // Delete photo
        if ($aparatur->foto) {
            Storage::disk('public')->delete($aparatur->foto);
        }

        $aparatur->delete();

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil dihapus.');
    }
}
