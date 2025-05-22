<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.barang', 'peminjaman.user')->latest()->get();
        return view('pengembalian', compact('pengembalians'));
    }

 public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'foto_pengembalian' => 'nullable|image|max:2048',
        ]);

        // Ambil data peminjaman berdasarkan ID yang dikirim
        $peminjaman = Peminjaman::with('pengembalian')->find($request->peminjaman_id);

        // Cek apakah peminjaman sudah dikembalikan
        if ($peminjaman->status === 'Sudah Dikembalikan') {

            return response()->json(['message' => 'Barang sudah dikembalikan.'], 400);
        }

        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto_pengembalian')) {
            $fotoPath = $request->file('foto_pengembalian')->store('foto_pengembalian', 'public');
        }

        // Buat data pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'foto_pengembalian' => $fotoPath,
        ]);

        // Update status peminjaman
        $peminjaman->status = 'Sudah Dikembalikan';
        $peminjaman->save();

        return response()->json([
            'message' => 'Pengembalian berhasil dicatat.',
            'pengembalian' => $pengembalian,
        ]);
    }

    // Endpoint untuk melihat detail pengembalian beserta gambar
    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.barang')->findOrFail($id);

        return response()->json([
            'pengembalian' => $pengembalian,
            'gambar_url' => $pengembalian->foto_pengembalian 
                ? asset('storage/' . $pengembalian->foto_pengembalian)
                : null
        ]);
    }

}
