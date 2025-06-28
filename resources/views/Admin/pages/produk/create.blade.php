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
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Produk</h4>
    @endsection

    @section('breadcrumb')
        <div class="d-flex align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('produk-list.index') }}">Index</a></li>
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
                        <h4 class="card-title">Form Tambah Produk</h4>
                        <h6 class="card-subtitle">Lengkapi data produk dengan benar sebelum menyimpan</h6>
                        <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h4 class="modal-title text-white" id="myCenterModalLabel">Upload File Import Produk</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('produk-list.import') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="file" class="col-sm-2 col-form-label">File</label>
                                                    <div class="col-sm-10">
                                                        <input  id="file" type="file" name="file" class="form-control mb-2" required>
                                                        <h6 class="card-subtitle">Masukkan file dengan format<code>.xlx atau .xlsx</code>
                                                    </div>
                                                </div>
                                                <div class="text-end mt-2">
                                                    <button type="submit" class="btn btn-success mb-2">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <div class="form-group text-end">
                            <a href="{{ route('produk-list.template') }}" class="btn btn-success mb-2">Unduh Template</a>
                            <button href="{{ route('produk-list.import') }}" data-bs-toggle="modal" data-bs-target="#centermodal" class="btn btn-outline-success mb-2">Import Produk</button>
                        <form action="{{ route('produk-list.store') }}" method="POST" class="mt-3 form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Produk">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="berat" class="col-sm-2 col-form-label">Berat Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" name="berat" id="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}" placeholder="Berat Produk">
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga_beli" id="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}" placeholder="0">
                                    @error('harga_beli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}" placeholder="0">
                                    @error('harga_jual')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="diskon" class="col-sm-2 col-form-label">Diskon (%)</label>
                                <div class="col-sm-10">
                                    <input type="number" name="diskon" id="diskon" class="form-control @error('diskon') is-invalid @enderror" value="{{ old('diskon', 0) }}" placeholder="0">
                                    @error('diskon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', 0) }}" placeholder="0">
                                    @error('stok')
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
