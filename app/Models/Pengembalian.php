<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

  protected $fillable = [
    'peminjaman_id',
    'foto_pengembalian',
    'keterangan',
    'tanggal_pengembalian',
    'status', // bisa null dulu
];


    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}