@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Produk</h4>
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
                        <h4 class="card-title">Daftar Produk</h4>
                        <h6 class="card-subtitle"><b></b>Menampilkan seluruh data produk dari berbagai kategori.</h6>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>
                        <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="customize-input">
                                            <select
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option selected>Kategori</option>
                                                <option value="1">AB</option>
                                                <option value="2">AK</option>
                                                <option value="3">BE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="customize-input">
                                            <select
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option selected>Status</option>
                                                <option value="1">AB</option>
                                                <option value="2">AK</option>
                                                <option value="3">BE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="customize-input">
                                            <select
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option selected>Stok</option>
                                                <option value="1">AB</option>
                                                <option value="2">AK</option>
                                                <option value="3">BE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="multi_col_order"
                                   class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Diskon (%)</th>
                                        <th>Stok</th>
                                        <th class="sorting_disabled">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset('storage/produk/' . $item->image) }}" alt="Gambar" style="max-width: 60px;">
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kategori->nama }}</td>
                                        <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                        <td>{{ $item->diskon }}%</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $item) }}" class="btn waves-effect waves-light btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('produk.destroy', $item) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin ingin menghapus produk {{ $item->nama }}?')" class="btn waves-effect waves-light btn-outline-danger"><i class="far fa-trash-alt"></i></button>
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
