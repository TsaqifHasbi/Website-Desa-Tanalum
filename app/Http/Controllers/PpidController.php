<?php

namespace App\Http\Controllers;

use App\Models\DokumenPpid;
use App\Models\KategoriPpid;
use App\Models\PermohonanInformasi;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpidController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $kategoriBerkala = KategoriPpid::active()->jenis('berkala')->ordered()->get();
        $kategoriSertaMerta = KategoriPpid::active()->jenis('serta_merta')->ordered()->get();
        $kategoriSetiapSaat = KategoriPpid::active()->jenis('setiap_saat')->ordered()->get();

        $dokumenTerbaru = DokumenPpid::with('kategori')
            ->active()
            ->latest()
            ->take(10)
            ->get();

        return view('ppid.index', compact(
            'profil',
            'kategoriBerkala',
            'kategoriSertaMerta',
            'kategoriSetiapSaat',
            'dokumenTerbaru'
        ));
    }

    public function dasarHukum()
    {
        $profil = ProfilDesa::first();

        return view('ppid.dasar-hukum', compact('profil'));
    }

    public function informasiBerkala(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriPpid::active()->jenis('berkala')->ordered()->get();

        $query = DokumenPpid::with('kategori')
            ->active()
            ->whereHas('kategori', function ($q) {
                $q->where('jenis', 'berkala');
            });

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $dokumens = $query->latest()->paginate(10);

        return view('ppid.informasi', compact('profil', 'kategoris', 'dokumens'))
            ->with('jenis', 'berkala')
            ->with('title', 'Informasi Secara Berkala');
    }

    public function informasiSertaMerta(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriPpid::active()->jenis('serta_merta')->ordered()->get();

        $query = DokumenPpid::with('kategori')
            ->active()
            ->whereHas('kategori', function ($q) {
                $q->where('jenis', 'serta_merta');
            });

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $dokumens = $query->latest()->paginate(10);

        return view('ppid.informasi', compact('profil', 'kategoris', 'dokumens'))
            ->with('jenis', 'serta_merta')
            ->with('title', 'Informasi Serta Merta');
    }

    public function informasiSetiapSaat(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriPpid::active()->jenis('setiap_saat')->ordered()->get();

        $query = DokumenPpid::with('kategori')
            ->active()
            ->whereHas('kategori', function ($q) {
                $q->where('jenis', 'setiap_saat');
            });

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $dokumens = $query->latest()->paginate(10);

        return view('ppid.informasi', compact('profil', 'kategoris', 'dokumens'))
            ->with('jenis', 'setiap_saat')
            ->with('title', 'Informasi Setiap Saat');
    }

    public function permohonanForm()
    {
        $profil = ProfilDesa::first();

        return view('ppid.permohonan', compact('profil'));
    }

    public function permohonanSubmit(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'nullable|string|size:16',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:255',
            'informasi_diminta' => 'required|string',
            'alasan_permohonan' => 'nullable|string',
            'cara_memperoleh' => 'required|in:melihat,membaca,mendengar,mencatat,mendapat_salinan',
            'cara_mendapat_salinan' => 'required|in:email,fax,pos,ambil_langsung',
        ]);

        $permohonan = PermohonanInformasi::create($validated);

        return redirect()->route('ppid.index')
            ->with('success', 'Permohonan informasi berhasil diajukan. Nomor tiket Anda: ' . $permohonan->nomor_tiket);
    }

    public function download($slug)
    {
        $dokumen = DokumenPpid::where('slug', $slug)->active()->firstOrFail();
        $dokumen->incrementDownloads();

        return Storage::download($dokumen->file_path, $dokumen->judul . '.' . pathinfo($dokumen->file_path, PATHINFO_EXTENSION));
    }

    public function view($slug)
    {
        $dokumen = DokumenPpid::where('slug', $slug)->active()->firstOrFail();
        $dokumen->incrementViews();

        return response()->file(Storage::path($dokumen->file_path));
    }
}
