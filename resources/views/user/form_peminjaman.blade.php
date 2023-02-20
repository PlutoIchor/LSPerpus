@extends('layouts.user')

@section('content')
    <form class="m-auto w-100 p-3 border rounded" method="POST" action="{{ route('user.create.peminjaman') }}">
        @csrf
        <h3><b>Form Peminjaman Buku</b></h3>
        <hr>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Nama Anggota</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ Auth::user()->fullname }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggal_peminjaman" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Buku</label>
            <div class="col-sm-9">
                <select class="form-control" id="exampleFormControlSelect1" name="id_buku" required>
                    <option value="" disabled selected hidden>Pilih Opsi</option>
                    @foreach ($kategoris as $k)
                        @if ($k->bukus->count() > 0)
                            <optgroup label="{{ $k->nama_kategori }}">
                                @foreach ($k->bukus->sortBy('judul_buku') as $buku)
                                    @if (isset($id_buku) && $buku->id == $id_buku)
                                        <option value="{{ $buku->id }}" selected>{{ $buku->judul_buku }}</option>
                                    @else
                                        <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @else
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kondisi Buku Saat Dipinjam</label>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_buku_saat_dipinjam"
                        id="kondisi_buku_saat_dipinjam1" value="Baik" checked>
                    <label class="form-check-label" for="kondisi_buku_saat_dipinjam1">
                        Baik
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_buku_saat_dipinjam"
                        id="kondisi_buku_saat_dipinjam2" value="Rusak">
                    <label class="form-check-label" for="kondisi_buku_saat_dipinjam2">
                        Rusak
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-secondary mt-2 w-100">PINJAM</button>
    </form>
@endsection
