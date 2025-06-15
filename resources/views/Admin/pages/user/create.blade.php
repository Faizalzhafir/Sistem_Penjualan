@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-dark font-weight-medium mb-1">Tambah User</h4>
    @endsection

    @section('breadcrumb')
    <div class="d-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('user.index') }}">Index</a></li>
                <li class="breadcrumb-item text-muted active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    @endsection

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Tambah User</h4>
            <h6 class="card-subtitle">Lengkapi data user dengan benar sebelum menyimpan</h6>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
