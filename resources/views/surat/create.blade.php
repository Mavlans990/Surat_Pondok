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
                            <form action="/surat" method="post" enctype="multipart/form-data">
                                @csrf
                                <h6>Nama Surat : </h6>
                                <input type="text" name="surat_judul" class="form-control" placeholder="Masukkan Nama..." value="{{ old('surat_judul') }}">
                                <h6>Tanggal Upload : </h6>
                                <input type="date" name="surat_tgl_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <h6>Nama Link : </h6>
                                <input type="text" name="surat_link" class="form-control" placeholder="Masukkan Nama..." value="{{ old('surat_link') }}">
                                <h6>Upload Surat : </h6>
                                <input type="file" class="form-control" name="surat_pdf">
                                <div class="button_tambah mt-4">
                                    <a href="/surat" class="btn btn-danger btn-sm btn-icon-split">
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