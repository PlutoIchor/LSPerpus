<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    
    protected $fillable= [
        'id_anggota',
        'id_buku',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'kondisi_buku_saat_dipinjam',
        'kondisi_buku_saat_dikembalikan',
        'denda'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }


    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
