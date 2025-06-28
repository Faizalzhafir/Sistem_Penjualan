@extends('Admin.layouts.main')

@section('content')

    @section('title')
    <h4 class="page-title text-dark font-weight-medium mb-1">Riwayat Transaksi</h4>
    @endsection

    
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">{{ $online }}</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">Jenis</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Online
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="cast"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">{{ $pending }}</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">Status</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pending
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="pause-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">{{ $lunas }}</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">Status</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Lunas
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="check-square"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Daftar Riwayat Transaksi</h4>
                <h6 class="card-subtitle"><b>Menampilkan daftar riwayat transaksi yang sudah dilakukan.</b></h6>
                    <!-- <div class="text-end mb-3">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i>
                            Export
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i class="far fa-file-pdf"></i> PDF</a>
                            <a class="dropdown-item" href="#"><i class="far fa-file-excel"></i> Excel</a>
                            <a class="dropdown-item" href="#"><i class="far fa-file-powerpoint"></i> Powerpoint</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Copy</a>
                        </div>
                    </div> -->
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap">
                            <thead class="bg-primary">
                                <tr class="text-white">
                                    <th>No</th>
                                    <th>Kasir</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Pembayaran</th>
                                    <th>Satus</th>
                                    <th class="sorting_disabled">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>Rp {{ number_format($item->bayar, 0, ',', '.') }}</td>
                                        <td>{{ Str::title(str_replace('_', ' ', $item->metode_pembayaran)) }}</td>
                                        <td>{{ Str::title(str_replace('_', ' ', $item->status_pembayaran)) }}</td>
                                        <td>
                                            <a class="dropdown-toggle"
                                                data-bs-toggle="dropdown"  href="#" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="text-primary dropdown-item" href="{{ route('transaksi.show', $item) }}"><i data-feather="eye"></i> Lihat Detail</a>
                                                <div class="dropdown-divider"></div>
                                                @if (auth()->user()->role === 'admin')
                                                <form action="{{ route('transaksi.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-primary dropdown-item" onclick="return confirm('Yakin ingin menghapus transaksi ini?')"><i data-feather="trash"></i> Hapus Data</button>
                                                </form>
                                                @else
                                                    
                                                @endif
                                            </div>
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

@endsection