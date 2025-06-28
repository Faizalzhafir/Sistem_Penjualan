@extends('user.layouts.app')

@section('content')
        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
          <div class="spinner-grow text-primary" role="status"></div>
      </div>
      <!-- Spinner End -->


      <!-- Hero Start -->
      <div class="container-fluid py-5 mb-5 hero-header bg-transparent">
          <div class="container py-5">
              <div class="row g-5 align-items-center">
                  <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 ">Selamat datang di</h4>
                      <h1 class="mb-5 display-3 ">{{ $setting->nama_toko }}</h1>
                  </div>
                  <div class="col-md-12 col-lg-5">
                      <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                          <div class="carousel-inner" role="listbox">
                              <div class="carousel-item active rounded">
                                  <img src="img/warung1.webp" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                              </div>
                              <div class="carousel-item rounded">
                                  <img src="img/warung1.webp" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                              </div>
                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Hero End -->


      <!-- Featurs Section Start -->
      <div class="container-fluid featurs py-5">
          <div class="container py-5">
              <div class="row g-4">
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-car-side fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>Free Shipping</h5>
                              <p class="mb-0">Free on order over $300</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-user-shield fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>Security Payment</h5>
                              <p class="mb-0">100% security payment</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-exchange-alt fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>30 Day Return</h5>
                              <p class="mb-0">30 day money guarantee</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fa fa-phone-alt fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>24/7 Support</h5>
                              <p class="mb-0">Support every time fast</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Featurs Section End -->

      <section class="container py-5">
        <div class="row align-items-center">
          <!-- Gambar Toko -->
          <div class="col-lg-6 mb-4 mb-lg-0 position-relative">
            <img src="img/warung2.jpg" alt="Toko SRC" class="img-fluid rounded shadow" style="z-index: 2; position: relative;">
            <!-- Ornamen background -->
            <div class="position-absolute top-50 start-0 translate-middle-y" style="z-index: 1;">
              <img src="ornamen.png" alt="" class="img-fluid" style="max-width: 150px; opacity: 0.3;">
            </div>
          </div>
      
          <!-- Konten Teks -->
          <div class="col-lg-6">
            <h2 class="fw-bold mb-2">Salam Kenal dari Kami,</h2>
            <h2 class="text-danger fw-bold mb-4">SRC Indonesia</h2>
            <p>
              SRC hadir dengan jaringan toko kelontong terbesar di Indonesia binaan PT SRC Indonesia Sembilan (SRC IS).
              SRC menghadirkan ekosistem yang terkoneksi sebagai bagian dari pendampingan usaha berkelanjutan untuk
              meningkatkan daya saing UMKM toko kelontong.
              SRC berkomitmen untuk menjadi solusi untuk semua, bagi mitra grosir, pemilik toko kelontong,
              dan pelanggan di Indonesia.
            </p>
          </div>
        </div>
      </section>
      
       <!-- Header -->
    <div class="text-center py-5 bg-light">
        <div class="container">
        <h1 class="display-5 fw-bold">Galeri Toko Kami</h1>
        <p>Lihat beberapa dokumentasi toko dan aktivitas kami.</p>
        </div>
    </div>
    <!-- Galeri -->
    <div class="py-5">
        <div class="container">
        <div class="row g-4">

            <!-- Gambar 1 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
            <img src="img/warung2.jpg" alt="Toko 1" class="img-fluid rounded gallery-img">
            </div>

            <!-- Gambar 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
            <img src="img/warung5.jpeg" alt="Toko 2" class="img-fluid rounded gallery-img">
            </div>

            <!-- Gambar 3 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
            <img src="img/warung3.jpg" alt="Toko 3" class="img-fluid rounded gallery-img">
            </div>

            <!-- Gambar 4 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
            <img src="img/warung4.jpg" alt="Toko 4" class="img-fluid rounded gallery-img">
            </div>

        </div>
        </div>
    </div>
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>  
@endsection
