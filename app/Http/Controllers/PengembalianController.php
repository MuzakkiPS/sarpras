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
    $request->validate([
        'peminjaman_id' => 'required|exists:peminjamans,id',
        'tanggal_pengembalian' => 'required|date',
        'keterangan' => 'nullable|string',
        'status' => 'nullable|string',
        'foto_pengembalian' => 'nullable|image|max:2048'
    ]);

    // Cek apakah pengembalian untuk peminjaman ini sudah ada
    if (Pengembalian::where('peminjaman_id', $request->peminjaman_id)->exists()) {
        return response()->json([
            'message' => 'Peminjaman ini sudah dikembalikan.'
        ], 400);
    }


     $fotoPath = null;
    if ($request->hasFile('foto_pengembalian')) {
        $fotoPath = $request->file('foto_pengembalian')->store('foto_pengembalian', 'public');
    }

    

    // Simpan data pengembalian
    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $request->peminjaman_id,
        'tanggal_pengembalian' => $request->tanggal_pengembalian,
        'keterangan' => $request->keterangan,
        'status' => $request->status ?? 'Baik',
        'foto_pengembalian' => $fotoPath
    ]);

    // Optional: update status peminjaman jadi 'disetujui' (jika sesuai)
    // atau update jadi status kustom kalau enum sudah ditambahkan
    Peminjaman::where('id', $request->peminjaman_id)
              ->update(['status' => 'disetujui']); // hanya jika enum-nya sesuai

    return response()->json([
        'message' => 'Pengembalian berhasil dicatat.',
        'data' => $pengembalian
    ], 201);
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
