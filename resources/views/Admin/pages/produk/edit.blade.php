@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Produk</h4>
    @endsection

    @section('breadcrumb')
    <div class="d-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('produk-list.index') }}">Index</a></li>
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
                        <h4 class="card-title">Form Edit Produk</h4>
                        <h6 class="card-subtitle"><b>Perbarui data produk dengan benar sebelum menyimpan</b></h6>

                        <form action="{{ route('produk-list.update', $produk_list) }}" method="POST" enctype="multipart/form-data" class="mt-3 form-horizontal">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ $produk_list->kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
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
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $produk_list->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="berat" class="col-sm-2 col-form-label">Berat Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" name="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat', $produk_list->berat) }}">
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Gambar Lama</label>
                                <div class="col-sm-10">
                                    @if($produk_list->image)
                                        <img src="{{ asset('storage/produk/' . $produk_list->image) }}" alt="Produk Image" width="100">
                                    @else
                                        <p>Tidak ada gambar</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Ganti Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $produk_list->harga_beli) }}">
                                    @error('harga_beli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $produk_list->harga_jual) }}">
                                    @error('harga_jual')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="diskon" class="col-sm-2 col-form-label">Diskon (%)</label>
                                <div class="col-sm-10">
                                    <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror" value="{{ old('diskon', $produk_list->diskon) }}">
                                    @error('diskon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $produk_list->stok) }}">
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary mt-2">Update</button>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-2">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
