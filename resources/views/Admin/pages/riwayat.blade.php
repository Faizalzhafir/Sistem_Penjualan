@extends('Admin.layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">236</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">+18.33%</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Clients
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">236</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">+18.33%</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Clients
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">236</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">+18.33%</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Clients
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-white mb-1 font-weight-medium">236</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium rounded-pill ms-2 d-lg-block d-md-none">+18.33%</span>
                                        </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Clients
                                    </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="btn-group dropright mb-3">
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
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr class="text-dark">
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Pembayaran</th>
                                    <th>Satus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection