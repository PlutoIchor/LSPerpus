@extends('layouts.admin')

@section('content')
    <h2><b>Data Peminjaman</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Peminjaman</li>
        </ol>
    </nav>
    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    <hr>
    <table class="table table-bordered" style="table-layout: fixed;">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center align-middle">No</th>
                <th scope="col" class="text-center align-middle" colspan="2">Nama Anggota</th>
                <th scope="col" class="text-center align-middle" colspan="2">Judul Buku</th>
                <th scope="col" class="text-center align-middle" colspan="2">Tanggal Peminjaman</th>
                <th scope="col" class="text-center align-middle" colspan="2">Tanggal Pengembalian</th>
                <th scope="col" class="text-center align-middle">Kondisi Buku Saat Dipinjam</th>
                <th scope="col" class="text-center align-middle">Kondisi Buku Saat Dikembalikan</th>
                <th scope="col" class="text-center align-middle" colspan="2">Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            @foreach ($peminjamans as $p)
                <tr>
                    <td class="text-center">{{ $peminjamans->perPage() * ($peminjamans->currentPage() - 1) + $count }}</td>
                    <?php $count++; ?>
                    <td colspan="2">{{ $p->user->fullname }}</td>
                    <td colspan="2">{{ $p->buku->judul_buku }}</td>
                    <td class="text-center" colspan="2">{{ $p->tanggal_peminjaman }}</td>
                    @if ($p->tanggal_pengembalian == null)
                        <td class="text-center text-muted" colspan="2"><i>- <i class="fa-solid fa-xmark"></i> -</i></td>
                    @else
                        <td class="text-center" colspan="2">{{ $p->tanggal_pengembalian }}</td>
                    @endif
                    <td class="text-center">{{ $p->kondisi_buku_saat_dipinjam }}</td>
                    <td class="text-center">{{ $p->kondisi_buku_saat_dikembalikan }}</td>
                    @if ($p->denda == null && isset($p->tanggal_pengembalian))
                        <td class="text-center text-success" colspan="2">Tidak ada denda</i></td>
                    @elseif($p->denda == null)
                        <td class="text-center" colspan="2"></td>
                    @else
                        <td class="text-center text-danger" colspan="2">Rp {{ $p->denda }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center mt-2">
        {{ $peminjamans->links('pagination::bootstrap-4') }}
    </div>
@endsection
