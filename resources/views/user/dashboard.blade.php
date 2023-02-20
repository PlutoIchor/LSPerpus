@extends('layouts.user')

@section('content')
    <h2><b>Dashboard</b></h2>
    <div class="alert alert-secondary" role="alert">
        Selamat Datang , {{ Auth::user()->fullname }}!
    </div>
    @foreach ($kategoris as $k)
        @if ($k->bukus->count() > 0)
            <hr>
            <nav class="navbar navbar-light bg-light">
                <h3><b>{{ $k->nama_kategori }}</b></h3>
            </nav>
            <div class="d-flex flex-row mt-2 bukus">
                @foreach ($k->bukus->sortBy('judul_buku') as $buku)
                    @if ($loop->iteration % 4 == 1)
            </div>
            <div class="d-flex flex-row mt-2 bukus">
        @endif
        <div class="mr-4">
            <div class="card border border-secondary" style="width: 16rem;">
                <img src="{{ url('/img' . '/' . $buku->foto) }}" style="height: 200px;object-fit: cover;"
                    class="card-img" alt="{{ $buku->judul_buku }}" data-toggle="modal"
                    data-target="#foto{{ $buku->id }}">
                <!-- Modal -->
                <div class="modal fade text-left " id="foto{{ $buku->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <center>
                                    <img src="{{ url('/img' . '/' . $buku->foto) }}" class="rounded border border-4 p-1"
                                        style="height: 450px;object-fit: cover;">
                                    <h3 class="mt-2"><b>{{ $buku->judul_buku }}</b></h3>
                                    <p>By : <a
                                            href="https://www.google.com/search?q={{ str_replace(' ', '_', $buku->pengarang) }}"
                                            target="_blank">{{ $buku->pengarang }}</a>, {{ $buku->tahun_terbit }}</p>
                                    <p>Stok : <span class="text-info">{{ $buku->j_buku_baik }} | <span
                                                class="text-muted">{{ $buku->j_buku_rusak }}</span></span></p>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><b>{{ $buku->judul_buku }}</b></h5>
                    @if ($buku->j_buku_baik + $buku->j_buku_rusak > 1)
                        <h5><span class="badge bg-success text-white">Tersedia</span></h5>
                    @else
                        <h5><span class="badge bg-danger text-white">Kosong</span></h5>
                    @endif
                    <p>By : <a href="https://www.google.com/search?q={{ str_replace(' ', '_', $buku->pengarang) }}"
                            target="_blank">{{ $buku->pengarang }}</a></p>
                    <p>Penerbit : {{ $buku->penerbit->nama_penerbit }}</p>
                    @if ($buku->j_buku_baik + $buku->j_buku_rusak > 1)
                        <a href="{{ url('user/form_peminjaman/' . $buku->id) }}" class="btn btn-info"><i
                                class="fa-solid fa-book-bookmark"></i> Pinjam</a>
                    @else
                        <a href="#" class="btn btn-warning text-black"><i class="fa-solid fa-bookmark"></i>
                            Bookmark</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>
    @endif
    @endforeach
@endsection
