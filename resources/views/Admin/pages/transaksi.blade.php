@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-dark font-weight-medium mb-1">Transaksi</h4>
    @endsection

    @section('breadcrumb')
    <div class="d-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-muted active" aria-current="page">Chart</li>
            </ol>
        </nav>
    </div>
    @endsection

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="card border-dark">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Transaksi Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <form action="#">
                            <div class="form-body">
                                <label class="form-label">Daftar Produk dan Detail Penjualan </label>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- <div class="col-md-9">
                                            <div class="form-group mb-3">
                                                <input type="search" class="form-control" placeholder="Cari Produk">
                                            </div>
                                        </div>
                                        <button type="button" style="display: inline;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#primary-header-modal">Primary Header</button> -->
                                        <div class="input-group">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <input type="search" class="form-control" placeholder="Cari Produk">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#primary-header-modal"><i class="far fa-plus-square"></i></button>
                                            </div>
                                        </div>
                                        <div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-colored-header bg-primary">
                                                        <h4 class="modal-title" id="primary-header-modalLabel">Modal Heading
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">Kode</th>
                                                                        <th scope="col">Nama</th>
                                                                        <th scope="col">Kategori</th>
                                                                        <th scope="col">Diskon</th>
                                                                        <th scope="col">Stok</th>
                                                                        <th scope="col">#</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($produk as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->kode }}</td>
                                                                        <td>{{ $item->nama }}</td>
                                                                        <td>{{ $item->kategori->nama }}</td>
                                                                        <td>{{ $item->diskon }}%</td>
                                                                        <td>{{ $item->stok }}</td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-sm btn-primary"><i class="far fa-arrow-alt-circle-down"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">Total Produk : <span>12</span></label>
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-transaksi">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center align-middle">
                                        <tr>
                                            <td>1</td>
                                            <td>Eichmann</td>
                                            <td>Nigam</td>
                                            <td>Eichmann</td>
                                            <td>Nigam</td>
                                            <td class="text-center align-middle">
                                                <input type="number" class="form-control" value="6" style="width: 70px;">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="number" class="form-control" value="8000" style="width: 150px;" readonly>
                                            </td>
                                            <td>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  class="btn btn-sm btn-rounded btn-danger"><i class="fas fa-window-close"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Eichmann</td>
                                            <td>Nigam</td>
                                            <td>Eichmann</td>
                                            <td>Nigam</td>
                                            <td class="text-center align-middle">
                                                <input type="number" class="form-control" value="6" style="width: 70px;">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="number" class="form-control" value="8000" style="width: 150px;">
                                            </td>
                                            <td>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  class="btn btn-sm btn-rounded btn-danger"><i class="fas fa-window-close"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions mt-3">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-dark">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Detail Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Total Diskon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Bayar</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Diterima</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Kembali</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-actions mt-3">
                                <div class="text-end">
                                    <a href="{{ route('cek') }}" class="btn btn-info"><i class="fas fa-shopping-cart"></i> Checkout</a>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#centermodal"><i class="fas fa-shopping-cart"></i> Checkout</button>
                                </div>
                                <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myCenterModalLabel">Center modal</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card text-center mt-2">
                                                    <div class="card-header bg-success">
                                                    <span class="text-white">TRANSAKSI BERHASIL !</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title">Transaksi sudah berhasil dilakukan, jangan lupa cek kembali uang pembayarannya</h4>
                                                        <p class="card-text">Dengan nomor transaksi :<span class="text-danger"> TRSOLN000001</span></p>
                                                        <a href="" class="btn btn-success">Cetak Nota</a>
                                                        <a href="" class="btn btn-primary">Buat E-Invoice</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
