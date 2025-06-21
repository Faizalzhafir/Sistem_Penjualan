@extends('Admin.layouts.main')

@section('content')

    @section('title')
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Riwayat Transaksi</h4>
    @endsection

    @section('breadcrumb')
        <div class="d-flex align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item text-muted active" aria-current="page"><a href="{{ route('riwayat') }}">Riwayat Transaksi</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Detail Riwayat Transaksi</li>
                </ol>
            </nav>
        </div>
    @endsection

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-7">
            <div class="card" >
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title "><i data-feather="clipboard"></i> | Detail Transaksi</h4>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <a href="{{ route('transaksi.nota', $transaksi->id) }}" class="btn btn-primary mt-2 mb-2" target="_blank">Cetak Nota</a>
                        </div>
                    </div>
                    <hr>
                    <h6 class="card-title ">Tanggal Transaksi : <span class="">{{ $transaksi->created_at->format('d M Y H:i') }}</span></h6>
                    <h6 class="card-title ">Kode Transaksi : <span class="">{{ $transaksi->kode_transaksi }}</span></h6>
                    <h6 class="card-title ">Kasir : <span class="">{{ $transaksi->user->name }}</span></h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th scope="col">No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->details as $item)
                                <tr class="table-primary">
                                    <td cope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-end text-dark">
                                <tr>
                                    <td colspan="3">Subtotal</td>
                                    <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Total Diskon</td>
                                    <td>Rp {{ number_format($transaksi->total_diskon, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <h4 class="card-title "><i data-feather="info"></i> | Detail Transaksi</h4>
                    <hr>
                    <div class="form-gorup row mt-3">
                        <label for="bayar"
                            class="col-sm-4 col-form-label  ">Bayar</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bayar" value="Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}" disabled>
                        </div>
                    </div>
                    <div class="form-gorup row mt-3">
                        <label for="diterima"
                            class="col-sm-4 col-form-label ">Diterima</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="diterima" value="Rp {{ number_format($transaksi->diterima, 0, ',', '.') }}" disabled>
                        </div>
                    </div>
                    <div class="form-gorup row mt-3">
                        <label for="jenis_transaksi"
                            class="col-sm-4 col-form-label ">Jenis Transaksi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jenis_transaksi" value="{{ ucfirst($transaksi->jenis_transaksi) }}" disabled>
                        </div>
                    </div>
                    <div class="form-gorup row mt-3">
                        <label for="metode_pembayaran"
                            class="col-sm-4 col-form-label ">Metode Pembayaran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="metode_pembayaran" value="{{ ucfirst($transaksi->metode_pembayaran) }}" disabled>
                        </div>
                    </div>
                    <div class="form-gorup row mt-3">
                        <label for="status_pembayaran"
                            class="col-sm-4 col-form-label ">Status Pembayaran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="status_pembayaran" value="{{ ucfirst($transaksi->status_pembayaran) }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection