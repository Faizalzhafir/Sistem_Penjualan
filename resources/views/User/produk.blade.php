@extends('user.layouts.app')

@section('content')
<pre>{{ dd($produk) }}</pre>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Produk</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
        <li class="breadcrumb-item active text-white">Produk</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Produk {{ $setting->nama_toko ?? '' }}</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <!-- Form Search -->
                <form action="{{ route('produk.cari') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="{{ request('keyword') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row g-4">
                    <!-- Sidebar Kategori -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <h4>Kategori</h4>
                            <ul class="list-unstyled fruite-categorie">
                                @foreach ($kategori as $item)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="{{ route('produk.index', ['kategori' => $item->id]) }}">
                                            <i class="fas fa-circle me-2"></i>{{ $item->nama }}
                                        </a>
                                        <span>({{ $item->produk_count }})</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Produk -->
                    <div class="col-lg-9">
                        <div class="row g-4">
                            @forelse ($produk as $item)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        @if (!empty($item->image))
                                            <img src="{{ asset('storage/produk/' . $item->image) }}" alt="{{ $item->nama }}" class="img-fluid w-100 rounded-top">
                                        @endif
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                        {{ $item->kategori->nama }}
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $item->nama }}</h4>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                                            @if(Auth::check())
                                            <form action="{{ route('keranjang.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah ke keranjang
                                                </button>
                                            </form>
                                            @else
                                            <a href="{{ route('login.index') }}" class="btn btn-primary">
                                                Login terlebih dulu
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">Produk tidak ditemukan.</p>
                            </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if ($produk->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav>
                                <ul class="pagination">
                                    <!-- Tombol Sebelumnya -->
                                    <li class="page-item {{ $produk->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $produk->previousPageUrl() }}" tabindex="-1">&laquo;</a>
                                    </li>

                                    <!-- Tombol Nomor -->
                                    @for ($i = 1; $i <= $produk->lastPage(); $i++)
                                        <li class="page-item {{ $i == $produk->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $produk->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Selanjutnya -->
                                    <li class="page-item {{ $produk->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $produk->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

@endsection
