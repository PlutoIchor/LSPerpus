@extends('layouts.admin')

@section('content')
    <h2><b>Data Anggota</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
        </ol>
    </nav>
    @if (\Session::has('successAdd'))
        <div class="alert alert-success d-flex align-items-center">
            {{ \Session::get('successAdd') }}
        </div>
    @endif
    <hr>
    <div class="d-flex flex-row">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info my-2" data-toggle="modal" data-target="#tambahAnggota">
            Tambah Anggota
        </button>
        {{-- Search Bar --}}
        <form action="{{ route('admin.search.anggota') }}" class="my-2 ml-4" style="width:70%;" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control " placeholder="Cari Anggota" name="search"
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.create.anggota') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kode User</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Kode User"
                                    name="kode_user" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">NIS</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="NIS" name="nis"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Username"
                                    name="username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Nama Lengkap"
                                    name="fullname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Kelas"
                                    name="kelas" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="staticEmail" placeholder="Password"
                                    name="password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($anggotas->count() > 0)
        <table class="table table-bordered" style="table-layout: fixed">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">No</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Foto</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Kode User</th>
                    <th scope="col" class="text-center align-middle">NIS</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Nama Lengkap</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Username</th>
                    <th scope="col" class="text-center align-middle">Kelas</th>
                    <th scope="col" class="text-center align-middle">Verif</th>
                    <th scope="col" class="text-center align-middle" colspan="3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($anggotas as $a)
                    <tr>
                        <td class="text-center">{{ $anggotas->perPage() * ($anggotas->currentPage() - 1) + $count }}</td>
                        <?php $count++; ?>
                        @if (isset($a->foto))
                            <td class="text-center" colspan="2"><img src="/img/{{ $a->foto }}"
                                    class="rounded-circle img-fluid" style="width: 150px;" alt="Avatar" /></td>
                        @else
                            <td class="text-center" colspan="2"><img src="/img/default.jpg"
                                    class="rounded-circle img-fluid" /></td>
                        @endif
                        <td class="text-center" colspan="2">{{ $a->kode_user }}</td>
                        <td class="text-center">{{ $a->nis }}</td>
                        <td colspan="2">{{ $a->fullname }}</td>
                        <td colspan="2">{{ $a->username }}</td>
                        <td class="text-center">{{ $a->kelas }}</td>
                        @if ($a->verif == 'verified')
                            <td class="text-center text-success">
                                <h4><i class="fa-solid fa-user-check"></i>
                            </td>
                            </h4>
                        @else
                            <td class="text-center text-danger">
                                <h4><i class="fa-solid fa-user-xmark"></i>
                            </td>
                            </h4>
                        @endif
                        <td class="text-center" colspan="3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#updateAnggota{{ $a->id }}">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-left" id="updateAnggota{{ $a->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Anggota
                                                {{ $a->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('admin/update_anggota/' . $a->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Kode
                                                        User</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Kode User" name="kode_user"
                                                            value="{{ $a->kode_user }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">NIS</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="NIS" name="nis" value="{{ $a->nis }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail"
                                                        class="col-sm-4 col-form-label">Username</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Username" name="username"
                                                            value="{{ $a->username }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Nama
                                                        Lengkap</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Nama Lengkap" name="fullname"
                                                            value="{{ $a->fullname }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Kelas</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Kelas" name="kelas"
                                                            value="{{ $a->kelas }}" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal"
                                data-target="#deleteAnggota{{ $a->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-left " id="deleteAnggota{{ $a->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Anggota</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h1><i class="fa-solid fa-trash"></i></h1>
                                            <h4>Apakah anda yakin ingin menghapus <b>{{ $a->fullname }}</b>?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ url('admin/delete_anggota/' . $a->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($a->verif == 'unverified')
                                <button type="button" class="btn btn-success mt-2" data-toggle="modal"
                                    data-target="#verifyAnggota{{ $a->id }}">
                                    Verify
                                </button>

                                <!-- Modal -->
                                <div class="modal fade text-left " id="verifyAnggota{{ $a->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Verify Anggota</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center text-success">
                                                <h1><i class="fa-solid fa-user-check"></i></h1>
                                                <h4>Apakah anda yakin ingin memverifikasi <b>{{ $a->fullname }}</b>?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST"
                                                    action="{{ url('admin/verify_anggota/' . $a->id) }}">
                                                    @method('POST')
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Verify</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center mt-2">
            {{ $anggotas->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-user-slash"></i></h1>
            <h3>Anggota tidak ditemukan</h3>
        </div>
    @endif
@endsection
