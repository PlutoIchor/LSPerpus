@extends('layouts.admin')

@section('content')
    <h2><b>Dashboard</b></h2>
    <div class="alert alert-secondary" role="alert">
        Selamat Datang {{ Auth::user()->fullname }}!
    </div>
    <hr>
    <div class="d-flex flex-row mt-4">
        <div class="card mr-4 border bg-danger text-white border-dark" style="width: 18rem;">
            <div class="card-body p-1 text-center">
                <h1><i class="fa-solid fa-book"></i></h1>
                <h4 class="card-title">{{ $bukus }} Buku</h4>
            </div>
        </div>
        <div class="card mr-4 bg-primary text-white" style="width: 18rem;">
            <div class="card-body p-1 text-center">
                <h1><i class="fa-solid fa-users"></i></h1>
                <h4 class="card-title">{{ $anggotas }} Anggota</h4>
            </div>
        </div>
        <div class="card mr-4 bg-info text-white" style="width: 18rem;">
            <div class="card-body p-1 text-center">
                <h1><i class="fa-solid fa-bookmark"></i></h1>
                <h5 class="card-title">{{ $peminjamans }} Peminjaman</h5>
            </div>
        </div>
        <div class="card bg-success text-white" style="width: 18rem;">
            <div class="card-body p-1 text-center">
                <h1><i class="fa-solid fa-hand-holding-hand"></i></h1>
                <h5 class="card-title">{{ $pengembalians }} Pengembalian Hari Ini</h5>
            </div>
        </div>
    </div>
    <div class="h-auto">
        <center class="mt-5">
            <img src="/img/{{ $id->foto }}" class="rounded img-fluid" style="width: 300px;" />
            <h4 class="mt-2">{{ $id->nama_app }}</h4>
            <h5>{{ $id->alamat }}</h5>
        </center>
    </div>
@endsection