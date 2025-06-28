@extends('user.layouts.app')

@section('content')
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
              <h1 class="mb-4">Fresh fruits shop</h1>
              <div class="row g-4">
                  <div class="col-lg-12">
                      <div class="row g-4">
                          <div class="col-xl-3">
                              <div class="input-group w-100 mx-auto d-flex">
                                  <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                  <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                              </div>
                          </div>
                          <div class="col-6"></div>
                          <div class="col-xl-3">
                              <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                  <label for="fruits">Default Sorting:</label>
                                  <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                      <option value="volvo">Nothing</option>
                                      <option value="saab">Popularity</option>
                                      <option value="opel">Organic</option>
                                      <option value="audi">Fantastic</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                      <div class="row g-4">
                          <div class="col-lg-3">
                              <div class="row g-4">
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <h4>Categories</h4>
                                          <ul class="list-unstyled fruite-categorie">
                                            @foreach ($kategori as $item)
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{ route('produk.index', ['kategori' => $item->id]) }}"><i class="fas fa-circle me-2"></i>{{ $item->nama }}</a>
                                                    <span>( {{ $item->produk_count }} )</span>
                                                </div>
                                            </li>
                                            @endforeach
                                          </ul>
                                      </div>
                                  </div>

                                  <div class="col-lg-12">
                                      <div class="position-relative">
                                          <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                          <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                              <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-9">
                              <div class="row g-4 justify-content-center">
                                @foreach ($produk as $item)
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            @if (!empty($item->image))
                                                <img src="{{ asset('storage/produk/' . $item->image) }}" alt="{{ $item->nama }}" class="img-fluid w-100 rounded-top">
                                            @endif
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $item->kategori->nama }}</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $item->nama }}</h4>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">Rp {{ number_format($item['harga_jual'], 0, ',', '.') }}</p>
                                                <!-- Tombol Keranjang -->
                                                @if(Auth::check())
                                                <form action="{{ route('keranjang.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah ke keranjang</button>
                                                </form>
                                                @else
                                                <!-- Jika belum login -->
                                                <a href="{{ route('login.index') }}" class="btn btn-primary">
                                                    Login terlebih dulu
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                  <div class="col-12">
                                      <div class="pagination d-flex justify-content-center mt-5">
                                          <a href="#" class="rounded">&laquo;</a>
                                          <a href="#" class="active rounded">1</a>
                                          <a href="#" class="rounded">2</a>
                                          <a href="#" class="rounded">3</a>
                                          <a href="#" class="rounded">4</a>
                                          <a href="#" class="rounded">5</a>
                                          <a href="#" class="rounded">6</a>
                                          <a href="#" class="rounded">&raquo;</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Fruits Shop End-->
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>  
@endsection