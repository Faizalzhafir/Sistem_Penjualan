@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Setting</h4>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Setting</h4>
                        <h6 class="card-subtitle">Lengkapi data dengan benar sebelum menyimpan</h6>
                        
                        <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group row mb-3">
                                <label for="nama_toko" class="col-sm-2 col-form-label">Nama toko</label>
                                <div class="col-sm-10">
                                  <input type="text" id="nama_toko" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" value="{{ old('nama_toko', $setting->nama_toko ?? '') }}" placeholder="Nama toko">
                                  @error('nama_toko')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                    
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                  <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $setting->alamat ?? '') }}" placeholder="Alamat">
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                              <label for="telepon" class="col-sm-2 col-form-label">No telepon</label>
                              <div class="col-sm-10">
                                <input type="number" id="telepon" name="telepon" value="{{ old('telepon', $setting->telepon ?? '') }}" class=" form-control @error('telepon') is-invalid @enderror" placeholder="085....">
                                  @error('telepon')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                            </div>

                            <div class="form-group row mb-3">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" id="email" name="email" value="{{ old('email', $setting->email ?? '') }}" class=" form-control @error('email') is-invalid @enderror" placeholder="...@gmail.com">
                                  @error('email')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <img src="" alt="">
                                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    @if (!empty($setting->logo))
                                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo toko" width="125px" class="mb-3">
                                    @endif
                                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                                    @error('logo')
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
