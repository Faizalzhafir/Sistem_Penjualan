@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Kategori</h4>
    @endsection

    @section('breadcrumb')
        <div class="d-flex align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('kategori.index') }}">Index</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Kategori</h4>
                            <h6 class="card-subtitle"><b>Perbarui data kategori dengan benar sebelum menyimpan</b></h6>
                            <form action="{{ route('kategori.update', $kategori['id']) }}" method="POST" enctype="multipart/form-data" class="mt-3 form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $kategori['nama']) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-2">Simpan</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-2">Batal</a>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection