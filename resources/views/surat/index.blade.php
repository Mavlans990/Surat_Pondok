@extends('layouts.main')

@section('isi')
<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Data Surat</h5>
                    <div class="dropdown no-arrow">
                        <a href="/surat/create" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="text">Tambah Surat</span>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Surat</th>
                                    <th>Tanggal Upload</th>
                                    <th>Barcode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->surat_judul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->surat_tgl_upload)->format('d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $surat->surat_qr_code) }} " target="_blank">
                                            <img src="{{ asset('storage/' . $surat->surat_qr_code) }}" width="100" alt="QR Code">
                                        </a>
                                    </td>
                                    <td>
                                        {{-- @if ($surat->surat_file) --}}
                                        <a href="{{ asset('storage/pdf_surat/' . $surat->surat_pdf) }}" target="_blank" class="btn btn-warning btn-sm">
                                            <span>Tampilan</span>
                                        </a>
                                        {{-- @endif --}}
                                        <a href="/surat/{{ $surat->surat_id }}/edit" class="btn btn-info btn-sm">
                                            <span>Edit</span>
                                        </a> 
                                        <form action="/surat/{{ $surat->surat_id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data ini ?')">
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection