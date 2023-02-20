@extends('layouts.admin')

@section('content')
    <h2><b>Pesan Terkirim</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pesan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesan Terkirim</li>
        </ol>
    </nav>
    <hr>
    <div class="d-flex flex-row">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kirimPesan">
            Kirim Pesan
        </button>
        {{-- Search Bar --}}
        <form action="{{ route('searchMessage') }}" class="ml-4" style="width:70%;" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control " placeholder="Cari Pesan" name="search"
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center mt-3">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    @if (\Session::has('fail'))
        <div class="alert alert-danger d-flex align-items-center mt-3">
            {{ \Session::get('fail') }}
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="kirimPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Kirim Pesan</h5>
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
    @if ($messages->count() == 0)
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-comment-slash"></i></h1>
            <h3>Anda belum pernah mengirim pesan</h3>
        </div>
    @endif
    <div class="mt-3">
        @foreach ($messages as $message)
            <div class="card mb-2">
                @if ($message->status == 'terkirim')
                    <div class="card-header bg-info text-white">
                        <i class="fa-solid fa-share-from-square"></i> Kepada <b>{{ $message->penerima->username }}</b>,
                        {{ $message->tanggal_kirim }}
                    </div>
                @else
                    <div class="card-header bg-secondary text-white">
                        <i class="fa-regular fa-envelope-open"></i> Kepada <b>{{ $message->penerima->username }}</b>,
                        {{ $message->tanggal_kirim }}
                    </div>
                @endif

                <div class="card-body">
                    <h5 class="card-title"><b><a
                                href="{{ url('pesan/' . $message->id) }}">{{ $message->judul_pesan }}</a></b></h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($message->isi_pesan, 15, $end = '...') }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination justify-content-center mt-2">
        {{ $messages->links('pagination::bootstrap-4') }}
    </div>
@endsection