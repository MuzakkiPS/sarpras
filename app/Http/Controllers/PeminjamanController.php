<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Barang;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'barang', 'pengembalian'])->latest()->get();
        return view('peminjaman', compact('peminjamans'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'tanggal_pinjam' => 'required|date',
        'jumlah' => 'required|integer|min:1', 
    ]);

    $barang = Barang::find($request->barang_id);

    // Cek apakah stok mencukupi
    if ($barang->stok < $request->jumlah) {
        return response()->json([
            'message' => 'Stok tidak mencukupi'
        ], 400);
    }

    // Kurangi stok
    $barang->stok -= $request->jumlah;
    $barang->save();

    $peminjaman = Peminjaman::create([
        'user_id' => auth()->id(),
        'barang_id' => $request->barang_id,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'jumlah' => $request->jumlah, 
        'status' => 'menunggu',
    ]);

    return response()->json([
        'message' => 'Peminjaman berhasil diajukan.',
        'data' => $peminjaman
    ], 201);
}
public function indexApi(Request $request)
{
    $user = $request->user(); // Mendapatkan user yang sedang login via token
    $peminjaman = Peminjaman::with(['barang', 'pengembalian'])
                    ->where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->get();

    return response()->json([
        'data' => $peminjaman
    ]);
}

}
