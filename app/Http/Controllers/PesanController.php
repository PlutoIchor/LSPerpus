<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function yourInbox()
    {
        $inbox = Pesan::where('id_penerima', '=', Auth::user()->id)->latest()->paginate(3)->withQueryString();
        if (Auth::user()->role == 'user') {
            return view('user.inbox', compact('inbox'));
        }
        return view('admin.inbox', compact('inbox'));
    }

    public function yourMessages()
    {
        $messages = Pesan::where('id_pengirim', '=', Auth::user()->id)->latest()->paginate(3)->withQueryString();
        if (Auth::user()->role == 'user') {
            return view('user.kirim_pesan', compact('messages'));
        }
        return view('admin.kirim_pesan', compact('messages'));
    }

    public function readMessage($id_pesan)
    {
        $pesan = Pesan::find($id_pesan);
        if ($pesan->status == 'terkirim' && $pesan->penerima->id == Auth::user()->id) {
            $pesan->status = 'terbaca';
            $pesan->save();
        }
        if (Auth::user()->role == 'user') {
            return view('user.pesan', compact('pesan'));
        }
        return view('admin.pesan', compact('pesan'));
    }

    public function createPesan(Request $request)
    {
        $penerima = User::where('username', $request->username)->first();
        if (!isset($penerima)) {
            return redirect()->back()->with('fail', 'User tidak ditemukan. Periksa apakah username yang dimasukkan sudah tepat');
        }
        Pesan::create([
            'id_penerima' => $penerima->id,
            'id_pengirim' => Auth::user()->id,
            'judul_pesan' => $request->judul_pesan,
            'isi_pesan' => $request->isi_pesan,
            'status' => 'terkirim',
            'tanggal_kirim' => now()
        ]);

        return redirect()->route('pesan.terkirim')->with('successAdd', "Berhasil mengirim pesan ke '$penerima->username'");
    }

    public function searchInbox(Request $request)
    {
        $searchEmpty = True;
        $inbox = Pesan::where([['id_penerima', Auth::user()->id], ['judul_pesan', 'like', "%" . $request->search . "%"]])
            ->orWhere([['id_penerima', Auth::user()->id], ['isi_pesan', 'like', "%" . $request->search . "%"]])->latest()->paginate(3)->withQueryString();

        if (Auth::user()->role == 'user') {
            return view('user.inbox', compact('inbox', 'searchEmpty'));
        }
        return view('admin.inbox', compact('inbox', 'searchEmpty'));
    }

    public function searchMessage(Request $request)
    {
        $searchEmpty = True;
        $messages = Pesan::where([['id_pengirim', Auth::user()->id], ['judul_pesan', 'like', "%" . $request->search . "%"]])
            ->orWhere([['id_pengirim', Auth::user()->id], ['isi_pesan', 'like', "%" . $request->search . "%"]])->latest()->paginate(3)->withQueryString();

        if (Auth::user()->role == 'user') {
            return view('user.kirim_pesan', compact('messages', 'searchEmpty'));
        }
        return view('admin.kirim_pesan', compact('messages', 'searchEmpty'));
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
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesan $pesan)
    {
        //
    }
}