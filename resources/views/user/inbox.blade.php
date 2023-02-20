@extends('layouts.user')

@section('content')
    <h2><b>Inbox</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pesan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inbox</li>
        </ol>
    </nav>
    <hr>
    {{-- Search Bar --}}
    <form action="{{ route('searchInbox') }}" style="width:70%;" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control " placeholder="Cari Pesan" name="search"
                value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
    @if ($inbox->count() == 0)
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-comment-slash"></i></h1>
            <h3>Anda tidak memiliki pesan</h3>
        </div>
    @endif
    <div class="mt-3">
        @foreach ($inbox as $pesan)
            <div class="card mb-2">
                @if ($pesan->status == 'terkirim')
                    <div class="card-header bg-primary text-white">
                        <i class="fa-regular fa-paper-plane"></i> Dari <b>{{ $pesan->pengirim->username }}</b>,
                        {{ $pesan->tanggal_kirim }}
                    </div>
                @else
                    <div class="card-header bg-secondary text-white">
                        <i class="fa-solid fa-check-double"></i> Dari <b>{{ $pesan->pengirim->username }}</b>,
                        {{ $pesan->tanggal_kirim }}
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title"><b><a href="{{ url('pesan/' . $pesan->id) }}">{{ $pesan->judul_pesan }}</a></b>
                    </h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($pesan->isi_pesan, 15, $end = '...') }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination justify-content-center mt-2">
        {{ $inbox->links('pagination::bootstrap-4') }}
    </div>
@endsection