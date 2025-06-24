@extends('Admin.layouts.main')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <h4 class="mb-0">Konfirmasi Transaksi</h4>
                <p class="text-muted mt-0 font-12">Add an optional header and/or footer within a card.</p>
                <div class="card text-center mt-2">
                    <div class="card-header bg-success">
                    <span class="text-white">TRANSAKSI BERHASIL !</span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Transaksi sudah berhasil dilakukan, jangan lupa cek kembali uang pembayarannya</h4>
                        <p class="card-text">Dengan nomor transaksi :<span class="text-danger"> {{ $transaksi->kode_transaksi }}</span></p>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali Transaksi</a>
                        <a href="{{ route('transaksi.nota', $transaksi->id) }}" class="btn btn-success" target="_blank">Cetak Nota</a>
                        <a href="" class="btn btn-primary">Buat E-Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection