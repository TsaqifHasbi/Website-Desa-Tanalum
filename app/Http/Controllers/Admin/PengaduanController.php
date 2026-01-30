<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                    ->orWhere('judul', 'like', '%' . $request->q . '%')
                    ->orWhere('nomor_tiket', 'like', '%' . $request->q . '%');
            });
        }

        $pengaduans = $query->latest()->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:baru,dibaca,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string',
        ]);

        if ($validated['status'] === 'selesai') {
            $validated['tanggal_selesai'] = now();
        }

        $pengaduan->update($validated);

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->lampiran) {
            foreach ($pengaduan->lampiran as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
