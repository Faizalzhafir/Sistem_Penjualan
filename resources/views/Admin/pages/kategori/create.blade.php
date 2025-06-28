@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @if (session('failures'))   
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
            <ul>
                @foreach (session('failures') as $failure)
                    <li>
                        Baris {{ $failure->row() }}:
                        @foreach ($failure->errors() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Kategori</h4>
    @endsection

    @section('breadcrumb')
        <div class="d-flex align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('kategori.index') }}">Index</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Tambah Kategori</h4>
                        <h6 class="card-subtitle">Lengkapi data kategori dengan benar sebelum menyimpan</h6>
                        <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h4 class="modal-title text-white" id="myCenterModalLabel">Upload File Import Kategori</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <form action="{{ route('kategori.import') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="file" class="col-sm-2 col-form-label">File</label>
                                                        <div class="col-sm-10">
                                                            <input id="file" type="file" name="file" class="form-control mb-2" required>
                                                            <h6 class="card-subtitle text-left">Masukkan file dengan format<code>.xlx atau .xlsx</code>
                                                        </div>
                                                    </div>
                                                    <div class="text-end mt-2">
                                                        <button type="submit" class="btn btn-success mb-2">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                        </div>
                        <div class="form-group text-end">
                            <a href="{{ route('kategori.template') }}" class="btn btn-success mb-2">Unduh Template</a>
                            <button href="{{ route('kategori.import') }}" data-bs-toggle="modal" data-bs-target="#centermodal" class="btn btn-outline-success mb-2">Import Kategori</button>
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data" class="mt-3 form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Kategori">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection