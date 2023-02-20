<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $bukus = Buku::count();
        $anggotas = User::where([['role', 'user'] , ['verif','verified']])->count();
        $peminjamans = Peminjaman::where('tanggal_pengembalian', null)->count();
        $pengembalians = Peminjaman::where('tanggal_pengembalian', today())->count();
        $id = Identitas::first();
        return view('admin.dashboard', compact('bukus', 'anggotas', 'peminjamans', 'pengembalians', 'id'));
    }

    public function user()
    {
        $kategoris = Kategori::get();
        $kategoris = $kategoris->sortByDesc('bukus');

        return view('user.dashboard', compact('kategoris'));
    }
}
