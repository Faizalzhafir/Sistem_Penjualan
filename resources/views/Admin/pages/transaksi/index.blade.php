@extends('Admin.layouts.main')

@section('content')
<div class="container">
    @section('title')
    <h4 class="page-title text-dark font-weight-medium mb-1">Transaksi</h4>
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
                            <div class="form-body">
                                <label class="form-label">Daftar Produk dan Detail Penjualan </label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                        <input type="search" class="form-control" placeholder="Masukkan kode Produk" id="inputKodeProduk">
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
                                                        <h4 class="modal-title" id="primary-header-modalLabel">Pilih Produk
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
                                                                        @php
                                                                            $produkJson = json_encode([
                                                                                "id" => $item->id,
                                                                                "kode" => $item->kode,
                                                                                "nama" => $item->nama,
                                                                                "kategori" => $item->kategori->nama,
                                                                                "diskon" => $item->diskon,
                                                                                "harga_jual" => $item->harga_jual,
                                                                            ]);
                                                                        @endphp

                                                                        <button type="button"
                                                                            class="btn btn-sm btn-primary"
                                                                            data-produk='{{ $produkJson }}'
                                                                            onclick="tambahProduk(this)">
                                                                            <i class="far fa-arrow-alt-circle-down"></i>
                                                                        </button>
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
                            <label class="form-label">Total Jenis Produk : <span id="total_produk">0</span></label>
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

                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions mt-3">
                                <div class="text-end">
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-dark">Reset</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-dark">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Detail Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                            <input type="hidden" name="produk_data" id="produk_data">
                            <input type="hidden" name="total" id="total_hidden">
                            <input type="hidden" name="total_diskon" id="total_diskon_hidden">
                            <input type="hidden" name="bayar" id="bayar_hidden">
                            <input type="hidden" name="diterima" id="diterima_hidden">
                            <input type="hidden" name="jenis_transaksi" value="offline">
                            <input type="hidden" name="metode_pembayaran" value="cash">
                            @csrf
                            <div class="form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Total Diskon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total_diskon" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Bayar</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="bayar" disabled>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Diterima</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="diterima">
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <label for="inputHorizontalSuccess"
                                    class="col-sm-4 col-form-label">Kembali</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="kembali" disabled>
                                </div>
                            </div>
                            <div class="form-actions mt-3">
                                <div class="text-end">
                                    <button onclick="submitForm()" class="btn btn-info"><i class="fas fa-shopping-cart"></i> Checkout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const produkList = @json($produk);

        let produkDipilih = [];

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('inputKodeProduk').addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // agar tidak reload/form submit
                    const kode = this.value.trim();

                    if (kode === '') return;

                    // Cari produk dari list
                    const dataProduk = produkList.find(p => p.kode === kode);

                    if (!dataProduk) {
                        alert('Produk tidak ditemukan!');
                        return;
                    }

                    // Tambahkan ke produkDipilih
                    masukKeTabel(dataProduk);

                    // Kosongkan input setelah berhasil
                    this.value = '';
                }
            });
        });

        function tambahProduk(button) {
            const dataProduk = JSON.parse(button.getAttribute('data-produk')); // parse dari data-produk
            masukKeTabel(dataProduk);

        }

        function masukKeTabel(dataProduk) {
            const sudahAda = produkDipilih.find(p => p.product_id === dataProduk.id);
            if (sudahAda) {
                alert('Produk sudah ditambahkan!');
                return;
            }

            produkDipilih.push({
                product_id: dataProduk.id,
                kode: dataProduk.kode,
                nama: dataProduk.nama,
                kategori: dataProduk.kategori,
                diskon: dataProduk.diskon,
                harga_jual: dataProduk.harga_jual,
                jumlah: 1,
            });

            renderTabel();
            simpanKeHiddenInput();
            hitungDetail()
        }

        function renderTabel() {
            let tbody = '';
            produkDipilih.forEach((p, index) => {
                tbody += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${p.kode}</td>
                        <td>${p.nama}</td>
                        <td>${p.kategori}</td>
                        <td>${p.diskon}%</td>
                        <td><input type="number" value="${p.jumlah}" min="1" onchange="ubahJumlah(${index}, this.value)" class="form-control" style="width:70px;"></td>
                        <td><input type="number" value="${p.jumlah * p.harga_jual}" class="form-control" readonly style="width:150px;"></td>
                        <td><button type="button" onclick="hapusProduk(${index})" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i></button></td>
                    </tr>
                `;
            });

            document.querySelector('.table-transaksi tbody').innerHTML = tbody;

            // Hitung total jumlah produk
            const totalProduk = produkDipilih.length;

            // Tampilkan ke <span id="total_produk">
            document.getElementById('total_produk').textContent = totalProduk;
        }

        function ubahJumlah(index, jumlah) {
            produkDipilih[index].jumlah = parseInt(jumlah);
            renderTabel();
            simpanKeHiddenInput();
            hitungDetail()
        }

        function hapusProduk(index) {
            produkDipilih.splice(index, 1);
            renderTabel();
            simpanKeHiddenInput();
            hitungDetail()
        }

        function simpanKeHiddenInput() {
            document.getElementById('produk_data').value = JSON.stringify(produkDipilih);
        }

        function hitungDetail() {
            let total = 0;
            let totalDiskon = 0;

            produkDipilih.forEach(p => {
                total += p.harga_jual * p.jumlah;
                totalDiskon += p.harga_jual * p.jumlah * (p.diskon / 100);
            });

            let bayar = total - totalDiskon;

            // Tampilkan ke input
            document.getElementById('total').value = total;
            document.getElementById('total_diskon').value = totalDiskon;
            document.getElementById('bayar').value = bayar;
            // Simpan ke input hidden
            document.getElementById('total_hidden').value = total;
            document.getElementById('total_diskon_hidden').value = totalDiskon;
            document.getElementById('bayar_hidden').value = bayar;

            // Cek kembali nilai diterima dan update kembalian
            const diterima = parseFloat(document.getElementById('diterima').value || 0);
            const kembali = diterima - bayar;
            document.getElementById('kembali').value = kembali >= 0 ? kembali : 0;
            document.getElementById('diterima_hidden').value = diterima;
        }

        // Ketika input diterima berubah, update kembalian
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('diterima').addEventListener('input', function () {
                hitungDetail();
            });
        });

        function submitForm() {
            // update nilai hidden input dari field visible
            hitungDetail(); // pastikan hitungan terakhir ter-update
            document.getElementById('formTransaksi').submit();
        }

    </script>
@endpush
