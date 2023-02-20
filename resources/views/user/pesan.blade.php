@extends('layouts.user')

@section('content')
    @if ($pesan->pengirim->id == Auth::user()->id)
        <h4>Kepada : {{ $pesan->penerima->fullname }} <span>({{ $pesan->penerima->username }})</span></h4>
    @else
        <h4>Dari : {{ $pesan->pengirim->fullname }} <span>({{ $pesan->pengirim->username }})</span></h4>
    @endif
    <h4>Pada : {{ $pesan->tanggal_kirim }}</h4>
    <hr>
    <div class="mt-4">
        <div class="card mb-2">
            <div class="card-body">
                <h3 class="card-title text-center"><b>{{ $pesan->judul_pesan }}</b></h3>
                <p class="card-text mt-4">{{ $pesan->isi_pesan }}</p>
            </div>
        </div>
    </div>
@endsection