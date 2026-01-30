<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kontak::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by subjek
        if ($request->filled('subjek')) {
            $query->where('subjek', $request->subjek);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $kontaks = $query->latest()->paginate(15);

        // Stats
        $stats = [
            'total' => Kontak::count(),
            'baru' => Kontak::where('status', 'baru')->count(),
            'dibalas' => Kontak::where('status', 'dibalas')->count(),
            'selesai' => Kontak::where('status', 'selesai')->count(),
        ];

        return view('admin.kontak.index', compact('kontaks', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontak $kontak)
    {
        // Mark as read if new
        if ($kontak->status === 'baru') {
            $kontak->update(['status' => 'dibaca']);
        }

        return view('admin.kontak.show', compact('kontak'));
    }

    /**
     * Reply to the message.
     */
    public function reply(Request $request, Kontak $kontak)
    {
        $request->validate([
            'balasan' => 'required|string',
        ]);

        $kontak->update([
            'balasan' => $request->balasan,
            'status' => 'dibalas',
            'dibalas_oleh' => auth()->id(),
            'dibalas_pada' => now(),
        ]);

        // Optionally send email notification to sender
        // Mail::to($kontak->email)->send(new ReplyMail($kontak));

        return redirect()->back()->with('success', 'Balasan berhasil disimpan.');
    }

    /**
     * Update the status.
     */
    public function updateStatus(Request $request, Kontak $kontak)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,dibalas,selesai',
        ]);

        $kontak->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
