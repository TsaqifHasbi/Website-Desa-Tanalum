<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        $profilDesa = ProfilDesa::first();

        return view('kontak', compact('profilDesa'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:5000',
        ]);

        // Save to database if Kontak model exists
        if (class_exists(Kontak::class)) {
            Kontak::create($validated);
        }

        // Alternatively, you can send email notification here
        // Mail::to(config('mail.admin_email'))->send(new ContactFormMail($validated));

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
