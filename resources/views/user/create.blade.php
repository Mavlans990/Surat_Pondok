@extends('layouts.main')

@section('isi')
<div class="container-fluid">
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Tambah User Baru</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/user" method="post">
                                @csrf
                                <h6>Nama User : </h6>
                                <input type="text" name="user_name" class="form-control" placeholder="Masukkan Nama..." value="{{ old('user_name') }}">
                                <h6>Password : </h6>
                                <input type="text" name="user_password" class="form-control" placeholder="Masukkan Password..." value="{{ old('user_password') }}">
                                <h6>Role : </h6>
                                <select name="user_role" class="form-control">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <div class="button_tambah mt-4">
                                    <a href="/user" class="btn btn-danger btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-left"></i>
                                        </span>
                                        <span class="text">Batal</span>
                                    </a> 
                                    <button type="submit" class="btn btn-success btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection