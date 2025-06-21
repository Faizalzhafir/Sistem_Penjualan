@extends('Admin.layouts.main')

@section('content')
    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan</h4>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="card border-end bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                                        </div>
                                    <span class="badge bg-dark font-12 text-white font-weight-medium rounded-pill d-lg-block d-md-none">Total Pendapatan</span>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-white"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="card border-end bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">Rp {{ number_format($totalDiskon, 0, ',', '.') }}</h2>
                                        </div>
                                    <span class="badge bg-dark font-12 text-white font-weight-medium rounded-pill d-lg-block d-md-none">Total Diskon</span>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-white"><i data-feather="percent"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="card border-end bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">Rp {{ number_format($totalDiterima, 0, ',', '.') }}</h2>
                                        </div>
                                    <span class="badge bg-dark font-12 text-white font-weight-medium rounded-pill d-lg-block d-md-none">Total Diterima</span>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-white"><i data-feather="arrow-down-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="card border-end bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">{{ $totalTransaksi }}</h2>
                                        </div>
                                    <span class="badge bg-dark font-12 text-white font-weight-medium rounded-pill d-lg-block d-md-none">Total Transaksi</span>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-white"><i data-feather="plus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Transaksi Periode : {{ $tanggal_awal }} - {{ $tanggal_akhir }} </h4>
                        <h6 class="card-subtitle"><b>Menampilkan seluruh data transaksi berdasarkan periode waktu yang telah ditentukan.</b></h6>
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#primary-header-modal">Ubah Periode</button>
                        <div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h4 class="modal-title" id="primary-header-modalLabel">Modal Heading
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-hidden="true"></button>
                                    </div>
                                    <form method="get">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="tanggal_awal"
                                                    class="col-sm-4 col-form-label">Tanggal Awal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" value="{{ request('tanggal_awal') }}" name="tanggal_awal">
                                                </div>
                                            </div>
                                            <div class="mt-3 form-group row">
                                                <label for="tanggal_akhir"
                                                    class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" value="{{ request('tanggal_akhir') }}" name="tanggal_akhir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i>
                                Export
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('laporan.pdf', request()->query()) }}" target="_blank"><i class="far fa-file-pdf"></i> PDF</a>
                                <a class="dropdown-item" href="{{ route('laporan.export.excel', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')] )}}"><i class="far fa-file-excel"></i> Excel</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config"
                                class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                <thead class="bg-primary">
                                    <tr class="text-white">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Total</th>
                                        <th>Metode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                            <td>{{ $item->kode_transaksi }}</td>
                                            <td>{{ $item->user->name ?? '-' }}</td>
                                            <td>Rp {{ number_format($item->bayar, 0, ',', '.') }}</td>
                                            <td>{{ ucfirst($item->metode_pembayaran) }}</td>
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

@endsection