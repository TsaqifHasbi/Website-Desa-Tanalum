<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $profilDesa = ProfilDesa::first();

        return view('admin.setting.index', compact('settings', 'profilDesa'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section', 'umum');

        // Handle different sections
        if ($section === 'profil') {
            return $this->updateProfil($request);
        } elseif ($section === 'kontak') {
            return $this->updateKontak($request);
        }

        // Default: update general settings
        $validated = $request->validate([
            'nama_website' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

        // Handle file uploads
        foreach (['logo', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                $oldSetting = Setting::where('key', $field)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
                $validated[$field] = $request->file($field)->store('settings', 'public');
            }
        }

        // Save settings
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        // Clear cache
        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }

    protected function updateProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'nullable|string|max:255',
            'kode_desa' => 'nullable|string|max:50',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ]);

        $profil = ProfilDesa::first();
        if ($profil) {
            $profil->update([
                'nama_desa' => $validated['nama_desa'] ?? $profil->nama_desa,
                'kode_desa' => $validated['kode_desa'] ?? $profil->kode_desa,
                'kecamatan' => $validated['kecamatan'] ?? $profil->kecamatan,
                'kabupaten' => $validated['kabupaten'] ?? $profil->kabupaten,
                'provinsi' => $validated['provinsi'] ?? $profil->provinsi,
                'kode_pos' => $validated['kode_pos'] ?? $profil->kode_pos,
                'alamat_kantor' => $validated['alamat'] ?? $profil->alamat_kantor,
                'latitude' => $validated['latitude'] ?? $profil->latitude,
                'longitude' => $validated['longitude'] ?? $profil->longitude,
            ]);
        } else {
            ProfilDesa::create([
                'nama_desa' => $validated['nama_desa'] ?? 'Tanalum',
                'kode_desa' => $validated['kode_desa'] ?? null,
                'kecamatan' => $validated['kecamatan'] ?? null,
                'kabupaten' => $validated['kabupaten'] ?? null,
                'provinsi' => $validated['provinsi'] ?? null,
                'kode_pos' => $validated['kode_pos'] ?? null,
                'alamat_kantor' => $validated['alamat'] ?? null,
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
            ]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Profil desa berhasil diperbarui.');
    }

    protected function updateKontak(Request $request)
    {
        $validated = $request->validate([
            'telepon' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        $profil = ProfilDesa::first();
        if ($profil) {
            // Update kontak langsung
            $profil->telepon = $validated['telepon'] ?? $profil->telepon;
            $profil->email = $validated['email'] ?? $profil->email;
            $profil->website = $validated['website'] ?? $profil->website;

            // Simpan sosial media sebagai JSON array
            $sosialMedia = [
                'whatsapp' => $validated['whatsapp'] ?? null,
                'facebook' => $validated['facebook'] ?? null,
                'instagram' => $validated['instagram'] ?? null,
                'youtube' => $validated['youtube'] ?? null,
                'twitter' => $validated['twitter'] ?? null,
                'tiktok' => $validated['tiktok'] ?? null,
            ];
            $profil->sosial_media = array_filter($sosialMedia);

            $profil->save();
        } else {
            ProfilDesa::create([
                'nama_desa' => 'Tanalum',
                'telepon' => $validated['telepon'] ?? null,
                'email' => $validated['email'] ?? null,
                'website' => $validated['website'] ?? null,
                'sosial_media' => array_filter([
                    'whatsapp' => $validated['whatsapp'] ?? null,
                    'facebook' => $validated['facebook'] ?? null,
                    'instagram' => $validated['instagram'] ?? null,
                    'youtube' => $validated['youtube'] ?? null,
                    'twitter' => $validated['twitter'] ?? null,
                    'tiktok' => $validated['tiktok'] ?? null,
                ]),
            ]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Kontak berhasil diperbarui.');
    }

    public function maintenance()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.setting.maintenance', compact('settings'));
    }

    public function updateMaintenance(Request $request)
    {
        $validated = $request->validate([
            'maintenance_mode' => 'nullable|boolean',
            'maintenance_message' => 'nullable|string',
        ]);

        $validated['maintenance_mode'] = $request->boolean('maintenance_mode') ? '1' : '0';

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.maintenance')
            ->with('success', 'Mode maintenance berhasil diperbarui.');
    }
}
