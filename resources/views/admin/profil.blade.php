@extends('layouts.admin')

@section('content')
    <div>
        <center>
            <h3><b>Profil Saya</b></h3>
        </center>
    </div>
    <hr>
    <div class="mb-3">
        <center>
            <img src="/img/{{ Auth::user()->foto == null ? 'profile.png' : Auth::user()->foto }}"
                class="rounded-circle border border-secondary" style="width: 250px;" alt="Avatar" />

        </center>
    </div>
    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    <form class="m-auto w-100 p-3 border rounded" method="POST" action="{{ route('user.update.profil') }}" enctype="multipart/form-data">
        @csrf
        <h4 class="mb-2">Edit Profil</h4>
        <hr>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Foto</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="foto">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Kode</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ Auth::user()->kode_user }}" name="kode_user" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ Auth::user()->username }}" name="username" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ Auth::user()->fullname }}" name="fullname" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" placeholder="Update Password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tanggal Bergabung</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ Auth::user()->join_date }}" disabled>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary mt-2 w-100">Ubah Profil</button>
    </form>
@endsection