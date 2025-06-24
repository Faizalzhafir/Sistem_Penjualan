@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kategori</h4>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Kategori</h4>
                        <h6 class="card-subtitle"><b>Menampilkan seluruh data berbagai kategori.</b></h6>
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-2">Tambah Kategori</a>
                        <div class="table-responsive">
                            <table id="zero_config"
                                class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                <thead class="bg-primary">
                                    <tr class="text-white">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th class="sorting_disabled">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>
                                            <a href="{{ route('kategori.edit', $item['id']) }}" class="btn waves-effect waves-light btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('kategori.destroy', $item['id']) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Apakah anda yakin ingin menghapus {{ $item['nama'] }} ?')" class="btn waves-effect waves-light btn-outline-danger"><i class="far fa-trash-alt"></i></button>
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
</div>
@endsection
