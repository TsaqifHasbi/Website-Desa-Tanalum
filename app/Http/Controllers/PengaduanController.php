<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $pengaduans = Pengaduan::public()
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);

        return view('pengaduan.index', compact('profil', 'pengaduans'));
    }

    public function create()
    {
        $profil = ProfilDesa::first();

        return view('pengaduan.create', compact('profil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|size:16',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'is_public' => 'nullable|boolean',
        ]);

        // Handle file uploads
        $lampiran = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $path = $file->store('pengaduan', 'public');
                $lampiran[] = $path;
            }
        }

        $validated['lampiran'] = $lampiran;
        $validated['is_public'] = $request->boolean('is_public');

        $pengaduan = Pengaduan::create($validated);

        return redirect()->route('pengaduan.cek', $pengaduan->nomor_tiket)
            ->with('success', 'Pengaduan berhasil dikirim. Nomor tiket Anda: ' . $pengaduan->nomor_tiket);
    }

    public function cekStatus($nomor_tiket)
    {
        $profil = ProfilDesa::first();
        $pengaduan = Pengaduan::where('nomor_tiket', $nomor_tiket)->firstOrFail();

        return view('pengaduan.cek', compact('profil', 'pengaduan'));
    }
}
