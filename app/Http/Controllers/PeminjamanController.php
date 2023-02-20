<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formPeminjaman($id_buku = null)
    {
        $kategoris = Kategori::get();
        $kategoris = $kategoris->sortByDesc('bukus');
        if (isset($id_buku)) {
            return view('user.form_peminjaman', compact('kategoris', 'id_buku'));
        }
        return view('user.form_peminjaman', compact('kategoris'));
    }

    public function viewPeminjaman()
    {
        $peminjamans = Peminjaman::where('id_anggota', '=', Auth::user()->id)->get();
        return view('user.peminjaman', compact('peminjamans'));
    }

    public function laporanPeminjaman()
    {
        $peminjamans = Peminjaman::paginate(5)->withQueryString();
        return view('admin.peminjaman', compact('peminjamans'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPeminjaman(Request $request)
    {
        Peminjaman::create([
            'id_anggota' => Auth::user()->id,
            'id_buku' => $request->id_buku,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'kondisi_buku_saat_dipinjam' => $request->kondisi_buku_saat_dipinjam
        ]);

        $buku = Buku::find($request->id_buku);
        if ($request->kondisi_buku_saat_dipinjam == 'Baik') {
            $buku->update([
                'j_buku_baik' => $buku->j_buku_baik - 1
            ]);
        } else {
            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak - 1
            ]);
        }


        return redirect()->route('user.riwayat.peminjaman')->with('successAdd', 'Berhasil meminjam buku');
    }
    public function createPengembalian(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::find($id_peminjaman);
        if ($peminjaman->kondisi_buku_saat_dipinjam == 'Baik' && $request->kondisi_buku_saat_dikembalikan == 'Rusak') {
            $peminjaman->update([
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
                'denda' => 20000
            ]);
        } elseif ($request->kondisi_buku_saat_dikembalikan == 'Hilang') {
            $peminjaman->update([
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
                'denda' => 50000
            ]);
        } else {
            $peminjaman->update([
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
            ]);
        }



        return redirect()->route('user.riwayat.pengembalian')->with('successAdd', 'Berhasil mengembalikan buku');
    }

    public function viewPengembalian()
    {
        $pengembalians = Peminjaman::where('id_anggota', '=', Auth::user()->id)
            ->whereNotNull('tanggal_pengembalian')->get();

        return view('user.pengembalian', compact('pengembalians'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
