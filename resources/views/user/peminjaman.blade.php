@extends('layouts.user')

@section('content')
    <h2><b>Riwayat Peminjaman</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
        </ol>
    </nav>
    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    <hr>
    @if ($peminjamans->count() > 0)
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Buku</th>
                    <th scope="col" class="text-center">Tanggal Peminjaman</th>
                    <th scope="col" class="text-center">Kondisi Buku Saat Dipinjam</th>
                    <th scope="col" class="text-center">Kembalikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->buku->judul_buku }}</td>
                        <td class="text-center">{{ $p->tanggal_peminjaman }}</td>
                        <td class="text-center">{{ $p->kondisi_buku_saat_dipinjam }}</td>
                        @if (isset($p->tanggal_pengembalian))
                            <td class="text-success text-center">(Sudah dikembalikan)</td>
                        @else
                            <td class="text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#pengembalian{{ $p->id }}"><i
                                        class="fa-solid fa-hand-holding-hand"></i>
                                </button>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="pengembalian{{ $p->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><b>PENGEMBALIAN BUKU</b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('user/create_pengembalian/' . $p->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Judul
                                                        Buku</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" readonly class="form-control" id="staticEmail"
                                                            value="{{ $p->buku->judul_buku }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Tanggal Pengembalian</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control"
                                                            name="tanggal_pengembalian" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Kondisi Buku Saat
                                                        Dikembalikan</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="kondisi_buku_saat_dikembalikan"
                                                                id="kondisi_buku_saat_dipinjam1" value="Baik" checked>
                                                            <label class="form-check-label"
                                                                for="kondisi_buku_saat_dipinjam1">
                                                                Baik
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="kondisi_buku_saat_dikembalikan"
                                                                id="kondisi_buku_saat_dipinjam2" value="Rusak">
                                                            <label class="form-check-label"
                                                                for="kondisi_buku_saat_dipinjam2">
                                                                Rusak
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="kondisi_buku_saat_dikembalikan"
                                                                id="kondisi_buku_saat_dipinjam2" value="Hilang">
                                                            <label class="form-check-label"
                                                                for="kondisi_buku_saat_dipinjam2">
                                                                Hilang
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary mt-2 w-100">KEMBALIKAN</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-book-open-reader"></i></h1>
            <h3>Anda belum pernah meminjam buku</h3>
        </div>
    @endif
@endsection
