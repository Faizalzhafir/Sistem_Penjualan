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
                        <a href="{{ route('produk-list.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>
                        <hr>
                            <div class="row">
                                <form method="GET" action="{{ route('produk-list.index') }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="kategori_id"
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option value=""> Semua Kategori </option>
                                                @foreach($kategori as $item)
                                                    <option value="{{ $item->id }}" {{ request('kategori_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="stok_status"
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option value=""> Semua Stok </option>
                                                <option value="kosong" {{ request('stok_status') == 'kosong' ? 'selected' : '' }}>Kosong</option>
                                                <option value="sedikit" {{ request('stok_status') == 'sedikit' ? 'selected' : '' }}>Sedikit</option>
                                                <option value="tersedia" {{ request('stok_status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="diskon_status"
                                                class="custom-select form-control bg-dark text-white custom-radius custom-shadow border-0">
                                                <option value=""> Semua Diskon </option>
                                                <option value="ada" {{ request('diskon_status') == 'ada' ? 'selected' : '' }}>Ada Diskon</option>
                                                <option value="tidak" {{ request('diskon_status') == 'tidak' ? 'selected' : '' }}>Tidak Ada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">Filter</button>
                                                <a href="{{ route('produk-list.index') }}" class="btn btn-dark">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                <thead class="bg-primary">
                                   <tr class="text-white">
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Berat</th>
                                        <th>Kategori</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Diskon (%)</th>
                                        <th>Stok</th>
                                        <th>Status</th>
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
                                        <td>{{ $item->berat }}</td>
                                        <td>{{ $item->kategori->nama }}</td>
                                        <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                        <td>{{ $item->diskon }}%</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            @if ($item->stok >= 1 && $item->stok <= 10)
                                                <span class="badge text-bg-warning">SEDIKIT</span>
                                            @elseif ($item->stok > 10)
                                                <span class="badge text-bg-success">TERSEDIA</span>
                                            @else
                                                <span class="badge text-bg-danger">KOSONG</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('produk-list.edit', $item) }}" class="btn waves-effect waves-light btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('produk-list.destroy', $item) }}" method="POST" style="display:inline;">
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
