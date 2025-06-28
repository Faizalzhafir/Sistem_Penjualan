@extends('user.layouts.app')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
  <h1 class="text-center text-white display-6">Keranjang</h1>
  <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
      <li class="breadcrumb-item active text-white">Keranjang</li>
  </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
  <div class="container py-5">
      <div class="table-responsive">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">Produk</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Banyak barang</th>
                  <th scope="col">Total</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($keranjang as $item)
                  <tr>
                      <th scope="row">
                          <div class="d-flex align-items-center">
                            @if (!empty($item->produk->image))
                                <img src="{{ asset('storage/produk/' . $item->produk->image) }}" alt="{{ $item->produk->nama }}" class="img-fluid me-5 " style="width: 80px; height: 60px;">
                            @endif
                          </div>
                      </th>
                      <td>
                          <p class="mb-0 mt-4">{{ $item->produk->nama }}</p>
                      </td>
                      <td>
                          <p class="mb-0 mt-4">Rp{{ $item->produk->harga_jual }}</p>
                      </td>
                      <td>
                          
                            <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="aksi" id="aksi-{{ $item->id }}" value="">
                            
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="submit" onclick="document.getElementById('aksi-{{ $item->id }}').value='kurang';" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                            
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $item->quantity }}" readonly>
                            
                                    <div class="input-group-btn">
                                        <button type="submit" onclick="document.getElementById('aksi-{{ $item->id }}').value='tambah';" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                            </form>                            
                          </div>
                      </td>
                      <td>
                          <p class="mb-0 mt-4">Rp{{ $item->produk->harga_jual * $item->quantity}}</p>
                      </td>
                      <td>
                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin manghapus {{ $item->produk->nama }} dari keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4" >
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-sm-10 col-md-9 col-lg-8 col-xl-6">
            <div class="bg-light rounded">
                <div class="p-4">
                    <h1 class="display-6 mb-4 text-center">Keranjang Total</h1>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0 me-4">Subtotal:</h5>
                        <p class="mb-0">$89.00</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0 me-4">Shipping</h5>
                        <div class="">
                            <p class="mb-0">Flat rate: $3.00</p>
                        </div>
                    </div>
                    <p class="mb-0 text-end">Shipping to Ukraine.</p>
                </div>
                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                    <p class="mb-0 pe-4">$99.00</p>
                </div>
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
            </div>
        </div>
    </div>
    
  </div>
</div>
<!-- Cart Page End -->
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>  
@endsection