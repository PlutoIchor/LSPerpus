<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPenerbit()
    {
        $penerbits = Penerbit::paginate(5)->withQueryString();
        return view('admin.penerbit', compact('penerbits'));
    }

    public function searchPenerbit(Request $request)
    {
        $penerbits = Penerbit::where('kode_penerbit', 'like', "%" . $request->search . "%")
            ->orWhere('nama_penerbit', 'like', "%" . $request->search . "%")
            ->paginate(5)->withQueryString();
        return view('admin.penerbit', compact('penerbits'));
    }

    public function createPenerbit(Request $request)
    {
        $penerbit = Penerbit::create([
            'kode_penerbit' => $request->kode_penerbit,
            'nama_penerbit' => $request->nama_penerbit,
            'verif_penerbit' => 'verified'
        ]);

        return redirect()->route('admin.penerbit')->with('successAdd', "Berhasil menambah penerbit '$penerbit->nama_penerbit'");
    }

    public function updatePenerbit(Request $request, $id_penerbit)
    {
        $penerbit = Penerbit::find($id_penerbit);
        $nama_penerbit = $penerbit->nama_penerbit;
        $penerbit->kode_penerbit = $request->kode_penerbit;
        $penerbit->nama_penerbit = $request->nama_penerbit;
        $penerbit->save();

        return redirect()->route('admin.penerbit')->with('successAdd', "Berhasil mengubah penerbit '$nama_penerbit'");
    }

    public function deletePenerbit($id_penerbit)
    {
        $penerbit = Penerbit::find($id_penerbit);
        $nama_penerbit = $penerbit->nama_penerbit;
        $penerbit->delete();

        return redirect()->route('admin.penerbit')->with('successAdd', "Berhasil menghapus penerbit '$nama_penerbit'");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerbit $penerbit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit)
    {
        //
    }
}