<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $fillable= [
        'id_penerima',
        'id_pengirim',
        'judul_pesan',
        'isi_pesan',
        'tanggal_kirim'
    ];

    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima');
    }
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }
}
