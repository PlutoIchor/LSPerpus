<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_user',
        'nis',
        'fullname',
        'username',
        'password',
        'kelas',
        'alamat',
        'verif',
        'role',
        'join_date',
        'foto',
        'terakhir_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }

    public function pesan_terkirim()
    {
        return $this->hasMany(Pesan::class, 'id_pengirim');
    }

    public function pesan_diterima()
    {
        return $this->hasMany(Pesan::class, 'id_penerima');
    }
}