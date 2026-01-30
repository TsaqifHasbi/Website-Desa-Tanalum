<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|max:512',
            'footer_text' => 'nullable|string',
            'footer_copyright' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_whatsapp' => 'nullable|string|max:50',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'social_tiktok' => 'nullable|url',
            'maps_embed' => 'nullable|string',
            'maps_lat' => 'nullable|string|max:50',
            'maps_lng' => 'nullable|string|max:50',
            'analytics_google' => 'nullable|string',
            'meta_author' => 'nullable|string|max:255',
        ]);

        // Handle file uploads
        foreach (['site_logo', 'site_favicon'] as $field) {
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

    public function maintenance()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.maintenance', compact('settings'));
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
