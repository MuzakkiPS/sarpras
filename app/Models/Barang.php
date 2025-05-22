<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

   
    protected $table = 'barang';

    protected $fillable = [
        'kategori_barang_id',
        'nama_barang',
        'deskripsi',
        'stok',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
}
