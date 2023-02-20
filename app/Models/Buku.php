<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable= [
        'judul_buku',
        'id_kategori',
        'id_penerbit',
        'pengarang',
        'tahun_terbit',
        'foto',
        'lsbn',
        'j_buku_baik',
        'j_buku_rusak'
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
