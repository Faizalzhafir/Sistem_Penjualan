<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
      <!-- Top Footer Section -->
      <div class="pb-4 mb-4 border-bottom" style="border-color: rgba(226, 175, 24, 0.5);">
        <div class="row g-4">
          <div class="col-lg-3">
            <a href="#">
              <h1 class="text-primary mb-0">Fruitables</h1>
            </a>
          </div>
        </div>
      </div>
  
      <div class="d-flex justify-content-between flex-wrap">
        <div class="footer-item me-3" style="flex: 1;">
          <h4 class="text-light mb-3">Alamat Toko {{ $setting->nama_toko ?? '' }}</h4>
          <p class="mb-4">{{ $setting->alamat ?? ''}}</p>
        </div>
      
        <div class="footer-item mx-3 text-start" style="flex: 1;">
          <h4 class="text-light mb-3">Menu</h4>
          <a class="btn-link" href="{{ url('/') }}">Beranda</a><br>
          <a class="btn-link" href="{{ url('produk') }}">Produk</a><br>
          <a class="btn-link" href="{{ url('keranjang') }}">Keranjang</a><br>
          <a class="btn-link" href="{{ url('kontak') }}">Kontak</a><br>
        </div>
      
        <div class="footer-item ms-3" style="flex: 1;">
          <h4 class="text-light mb-3">Kontak</h4>
          <p>Email: {{ $setting->email ?? ''}}</p>
          <p>No Telp: {{ $setting->telepon ?? ''}}</p>
          <p>Payment Accepted</p>
          <img src="img/payment.png" class="img-fluid" alt="">
        </div>
      </div>
      