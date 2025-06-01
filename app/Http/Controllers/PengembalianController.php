<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    // Menampilkan daftar pengembalian (web)
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.barang', 'peminjaman.user'])->get();
        return view('pengembalian', compact('pengembalians'));
    }

    // Update status pengembalian (disetujui / ditolak)
   public function updateStatus(Request $request, $id)
{
    $pengembalian = Pengembalian::findOrFail($id);
    $statusBaru = $request->status;

    $allowedStatuses = ['Menunggu konfirmasi', 'disetujui', 'ditolak'];
    if (!in_array($statusBaru, $allowedStatuses)) {
        return redirect()->back()->with('error', 'Status tidak valid');
    }

    $statusLama = $pengembalian->status;
    $pengembalian->status = $statusBaru;
    $pengembalian->save();

    $peminjaman = $pengembalian->peminjaman;

    if ($statusBaru === 'disetujui' && $statusLama !== 'disetujui') {
        // Update status peminjaman
        $peminjaman->status = 'sudah dikembalikan';
        $peminjaman->save();

        // Tambah stok kembali
        $barang = $peminjaman->barang;
        $barang->stok += $peminjaman->jumlah;
        $barang->save();
    } elseif ($statusLama === 'disetujui' && $statusBaru !== 'disetujui') {
        // Jika status sebelumnya disetujui, dan sekarang ditolak, kurangi stok lagi
        $peminjaman->status = 'belum dikembalikan';
        $peminjaman->save();

        // Kurangi stok kembali
        $barang = $peminjaman->barang;
        $barang->stok -= $peminjaman->jumlah;
        $barang->save();
    }

    return redirect()->route('pengembalian.index')->with('success', 'Status pengembalian berhasil diperbarui.');
}

    // Simpan pengembalian via API/Postman
public function store(Request $request, $peminjaman_id)
{
    $validator = Validator::make($request->all(), [
        'foto_pengembalian' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'keterangan' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
    }

    $peminjaman = Peminjaman::find($peminjaman_id);
    if (!$peminjaman) {
        return response()->json(['message' => 'Data peminjaman tidak ditemukan'], 404);
    }

    if ($peminjaman->status !== 'disetujui') {
        return response()->json(['message' => 'Pengembalian hanya bisa dilakukan jika peminjaman sudah disetujui'], 400);
    }

    // Cegah pengembalian ganda
    $existing = Pengembalian::where('peminjaman_id', $peminjaman_id)->first();
    if ($existing) {
        return response()->json(['message' => 'Pengembalian untuk peminjaman ini sudah pernah dilakukan'], 409);
    }

    $foto = $request->file('foto_pengembalian');
    $namaFoto = time() . '_' . $foto->getClientOriginalName();
    $path = $foto->storeAs('foto_pengembalian', $namaFoto, 'public');

    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $peminjaman_id,
        'foto_pengembalian' => $path,
        'keterangan' => $request->keterangan,
        'tanggal_pengembalian' => now(),
        'status' => 'Menunggu konfirmasi',
    ]);

    return response()->json([
        'message' => 'Pengembalian berhasil disimpan, menunggu konfirmasi',
        'data' => $pengembalian
    ], 201);



        $path = $foto->storeAs('foto_pengembalian', $namaFoto, 'public');

// Tambahkan untuk debug sementara:
if (!file_exists(storage_path("app/public/foto_pengembalian/$namaFoto"))) {
    return response()->json([
        'message' => 'Gagal menyimpan foto',
        'path' => $path
    ], 500);
}

    }
    
}
