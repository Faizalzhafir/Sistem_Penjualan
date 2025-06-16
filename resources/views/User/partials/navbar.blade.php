        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
          <div class="container px-0">
              <nav class=" navbar navbar-light bg-white navbar-expand-xl">
                  <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                  <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                      <span class="fa fa-bars text-primary"></span>
                  </button>
                  <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                      <div class="navbar-nav mx-auto">
                          <a href="{{ url('/') }}" class="nav-item nav-link active">Beranda</a>
                          <a href="{{ url('produk') }}" class="nav-item nav-link">Produk</a>
                          <a href="{{ url('keranjang') }}" class="nav-item nav-link">Keranjang</a>
                          <a href="{{ url('kontak') }}" class="nav-item nav-link">Kontak</a>
                      </div>
                      <div class="d-flex m-3 me-0">
                        @guest
                            <a href="{{ url('login') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                        @else
                        <div class="d-flex align-items-center">
                            <a href="#" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <a href="{{ route('logout') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none ms-3">
                                <i class="fas fa-sign-in-alt me-2"></i> Logout
                            </a>
                        </div>
                        @endguest
                          
                      </div>
                  </div>
              </nav>
          </div>
      </div>
      <!-- Navbar End -->