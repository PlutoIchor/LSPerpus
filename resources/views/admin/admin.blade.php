@extends('layouts.admin')

@section('content')
    <h2><b>Data Admin</b></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
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
        <button type="button" class="btn btn-info my-2" data-toggle="modal" data-target="#tambahAdmin">
            Tambah Admin
        </button>
        {{-- Search Bar --}}
        <form action="{{ route('admin.search.admin') }}" class="my-2 ml-4" style="width:70%;" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control " placeholder="Cari Admin" name="search"
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
    <div class="modal fade" id="tambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.create.admin') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kode Admin</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Kode Admin"
                                    name="kode_user" required>
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
                            <label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" placeholder="Username"
                                    name="username" required>
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
    @if ($admins->count() > 0)
        <table class="table table-bordered" style="table-layout: fixed">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">No</th>
                    <th scope="col" class="text-center align-middle">Kode Admin</th>
                    <th scope="col" class="text-center align-middle" colspan="3">Nama Lengkap</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Username</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Terakhir Login</th>
                    <th scope="col" class="text-center align-middle" colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($admins as $a)
                    <tr>
                        <td class="text-center">{{ $admins->perPage() * ($admins->currentPage() - 1) + $count }}</td>
                        <?php $count++; ?>
                        <td class="text-center">{{ $a->kode_user }}</td>
                        <td colspan="3">{{ $a->fullname }}</td>
                        @if ($a->id == Auth::user()->id)
                            <td colspan="2">{{ $a->username }} <i class="text-muted">(Anda)</i></td>
                        @else
                            <td colspan="2">{{ $a->username }}</td>
                        @endif
                        @if (isset($a->terakhir_login))
                            <td class="text-center" colspan="2">{{ $a->terakhir_login }}</td>
                        @else
                            <td class="text-center text-muted" colspan="2">-- Tidak Diketahui --</td>
                        @endif
                        <td class="text-center" colspan="2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#updateAdmin{{ $a->id }}">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-left" id="updateAdmin{{ $a->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Admin
                                                {{ $a->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('admin/update_admin/' . $a->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Kode
                                                        Admin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Kode Admin" name="kode_user"
                                                            value="{{ $a->kode_user }}" required>
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
                                                    <label for="staticEmail"
                                                        class="col-sm-4 col-form-label">Username</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="staticEmail"
                                                            placeholder="Username" name="username"
                                                            value="{{ $a->username }}" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteAdmin{{ $a->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-left " id="deleteAdmin{{ $a->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h1><i class="fa-solid fa-trash"></i></h1>
                                            <h4>Apakah anda yakin ingin menghapus<br>admin <b>{{ $a->username }}</b>?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ url('admin/delete_admin/' . $a->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center mt-2">
            {{ $admins->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="d-flex w-100 h-100 flex-column align-items-center justify-content-center">
            <h1><i class="fa-solid fa-user-slash"></i></h1>
            <h3>Admin tidak ditemukan</h3>
        </div>
    @endif
@endsection
