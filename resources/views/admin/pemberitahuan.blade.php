@extends('layouts.admin')

@section('content')
    <h2><b>Pemberitahuan</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pesan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemberitahuan</li>
        </ol>
    </nav>
    <hr>
    <div class="d-flex flex-row">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kirimPesan">
            Buat Pemberitahuan
        </button>
        {{-- Search Bar --}}
        <form action="#" class="ml-4" style="width:70%;" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control " placeholder="Cari Pemberitahuan" name="search"
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="kirimPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Buat Pemberitahuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('create.pesan') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Kepada</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Username"
                                        name="username" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Judul</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Judul Pesan"
                                        required name="judul_pesan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Isi Pesan</label>
                                <textarea class="form-control" aria-label="With textarea" name="isi_pesan" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        @foreach ($pemberitahuans as $p)
            <div class="card mb-2">
                @if ($p->status == 'aktif')
                    <div class="card-header bg-info text-white">
                        <i class="fa-solid fa-toggle-on"></i> Dibuat pada tanggal <b>{{ $p->created_at }}</b>,
                        <b>Aktif</b>
                    </div>
                @else
                    <div class="card-header bg-secondary text-white">
                        <i class="fa-solid fa-toggle-off"></i> Dibuat pada tanggal <b>{{ $p->created_at }}</b>,
                        <b>Nonaktif</b>
                    </div>
                @endif

                <div class="card-body">
                    <p class="card-text">{{ $p->isi_pemberitahuan }}</p>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="pagination justify-content-center mt-2">
        {{ $inbox->links('pagination::bootstrap-4') }}
    </div> --}}
@endsection
