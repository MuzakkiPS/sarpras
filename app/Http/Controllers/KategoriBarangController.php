<?php
namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use App\Models\Barang;
class KategoriBarangController extends Controller
{
    public function barang()
{
    return $this->hasMany(Barang::class);
}

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('index')->with('success', 'Kategori berhasil ditambahkan!');
    }  

    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('index', compact('kategori'));
    }

public function edit($id)
{
    $kategori = KategoriBarang::findOrFail($id);
    return view('kategori.edit', compact('kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    $kategori = KategoriBarang::findOrFail($id);
    $kategori->update(['nama_kategori' => $request->nama_kategori]);

    return redirect()->route('index')->with('success', 'Kategori berhasil diupdate.');
}

public function destroy($id)
{
    $kategori = KategoriBarang::findOrFail($id);
    $kategori->delete();

    return redirect()->route('index')->with('success', 'Kategori berhasil dihapus.');
}



}