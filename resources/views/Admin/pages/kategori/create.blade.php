@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Kategori</h4>
    @endsection

    @section('breadcrumb')
        <div class="d-flex align-items-center">
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