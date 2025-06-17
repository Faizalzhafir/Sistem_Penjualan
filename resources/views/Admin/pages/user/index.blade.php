@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-dark font-weight-medium mb-1">User</h4>
    @endsection

    @section('breadcrumb')
    <div class="d-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-muted active" aria-current="page">Index</li>
            </ol>
        </nav>
    </div>
    @endsection

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar User</h4>
                <h6 class="card-subtitle"><b>Menampilkan seluruh data user.</b></h6>
                <a href="{{ route('user.create') }}" class="btn btn-primary mb-2">Tambah User</a>
            <div class="table-responsive">
                <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap">
                    <thead class="bg-primary">
                        <tr class="text-white">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="sorting_disabled">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ ucfirst($item->role) }}</td>
                            <td>
                                <a href="{{ route('user.edit', $item) }}" class="btn waves-effect waves-light btn-outline-primary"><i class="far fa-edit"></i></a>
                                <form action="{{ route('user.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus {{ $item->name }}?')" class="btn waves-effect waves-light btn-outline-danger"><i class="far fa-trash-alt"></i></button>
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
@endsection
