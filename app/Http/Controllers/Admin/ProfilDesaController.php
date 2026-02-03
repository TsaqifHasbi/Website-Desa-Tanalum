<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\AparaturDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();

        return view('admin.profil-desa.index', compact('profil'));
    }

    public function edit()
    {
        $profil = ProfilDesa::first();

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kode_desa' => 'nullable|string|max:50',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'luas_wilayah' => 'nullable|numeric',
            'ketinggian' => 'nullable|string|max:100',
            'batas_utara' => 'nullable|string|max:255',
            'batas_selatan' => 'nullable|string|max:255',
            'batas_timur' => 'nullable|string|max:255',
            'batas_barat' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:100',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'peta_desa_iframe' => 'nullable|string',
            'foto_kantor' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Process coordinates
        if ($request->filled('koordinat')) {
            $coords = explode(',', $request->koordinat);
            if (count($coords) === 2) {
                $validated['latitude'] = trim($coords[0]);
                $validated['longitude'] = trim($coords[1]);
            }
        }
        unset($validated['koordinat']);

        // Handle Peta Desa Iframe
        if ($request->has('peta_desa_iframe')) {
            $validated['peta_desa'] = $request->peta_desa_iframe;
        }
        unset($validated['peta_desa_iframe']);

        $profil = ProfilDesa::first();

        // Handle file uploads
        foreach (['logo', 'foto_kantor', 'struktur_organisasi'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($profil && $profil->$field) {
                    Storage::disk('public')->delete($profil->$field);
                }
                $validated[$field] = $request->file($field)->store('profil', 'public');
            }
        }

        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilDesa::create($validated);
        }

        return redirect()->route('admin.profil')
            ->with('success', 'Profil desa berhasil diperbarui.');
    }

    // Aparatur Desa
    public function aparaturs()
    {
        $aparaturs = AparaturDesa::ordered()->paginate(10);

        return view('admin.aparatur.index', compact('aparaturs'));
    }

    public function aparaturCreate()
    {
        return view('admin.aparatur.create');
    }

    public function aparaturStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:16',
            'jabatan' => 'required|string|max:255',
            'tipe' => 'required|in:pemerintah_desa,bpd',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'pendidikan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        AparaturDesa::create($validated);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Aparatur desa berhasil ditambahkan.');
    }

    public function aparaturEdit(AparaturDesa $aparatur)
    {
        return view('admin.aparatur.edit', compact('aparatur'));
    }

    public function aparaturUpdate(Request $request, AparaturDesa $aparatur)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:16',
            'jabatan' => 'required|string|max:255',
            'tipe' => 'required|in:pemerintah_desa,bpd',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'pendidikan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($aparatur->foto) {
                Storage::disk('public')->delete($aparatur->foto);
            }
            $validated['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $aparatur->update($validated);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Aparatur desa berhasil diperbarui.');
    }

    public function aparaturDestroy(AparaturDesa $aparatur)
    {
        if ($aparatur->foto) {
            Storage::disk('public')->delete($aparatur->foto);
        }

        $aparatur->delete();

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Aparatur desa berhasil dihapus.');
    }
}
