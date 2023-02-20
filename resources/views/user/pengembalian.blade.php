@extends('layouts.user')

@section('content')
    <h2><b>Riwayat Pengembalian</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Pengembalian</li>
        </ol>
    </nav>
    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    <hr>
    @if ($pengembalians->count() > 0)
        <table class="table table-bordered" style="table-layout: fixed;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">No</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Buku</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Tanggal Peminjaman</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Tanggal Pengembalian</th>
                    <th scope="col" class="text-center align-middle">Kondisi Buku Saat Dipinjam</th>
                    <th scope="col" class="text-center align-middle">Kondisi Buku Saat Dikembalikan</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td colspan="2">{{ $p->buku->judul_buku }}</td>
                        <td class="text-center" colspan="2">{{ $p->tanggal_peminjaman }}</td>
                        <td class="text-center" colspan="2">{{ $p->tanggal_pengembalian }}</td>
                        <td class="text-center">{{ $p->kondisi_buku_saat_dipinjam }}</td>
                        <td class="text-center">{{ $p->kondisi_buku_saat_dikembalikan }}</td>
                        @if ($p->denda == null)
                            <td class="text-success text-center" colspan="2">Tidak ada denda</td>
                        @else
                            <td class="text-danger text-center" colspan="2">Rp. {{ $p->denda }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-hand-holding-hand"></i></h1>
            <h3>Anda belum pernah mengembalikan buku</h3>
        </div>
    @endif
@endsection
