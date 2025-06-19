<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nota Penjualan</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            line-height: 1.2;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border-bottom: 1px dotted #000;
            padding: 4px;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .no-border td {
            border: none;
        }
        .total {
            font-weight: bold;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="center">
        <h4>{{ $setting->nama_toko }}</h4>
        <p>{{ $setting->alamat }}</p>
        <p>Telp: {{ $setting->telepon }} | Email: {{ $setting->email }}</p>
        <hr>
    </div>

    <p>Nota Penjualan: <strong>{{ $transaksi->kode_transaksi }}</strong></p>
    <p>Tanggal: {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>
    <p>Kasir: {{ $transaksi->user->name }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th style="width: 30%">Nama Produk</th>
                <th>Berat</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->details as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->produk->kode }}</td>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->produk->berat ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->produk->diskon ?? 0 }}%</td>
                    <td class="text-right">
                        {{ number_format($item->price * $item->quantity * (1 - ($item->produk->diskon ?? 0)/100), 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <table class="no-border">
        <tr>
            <td colspan="7" class="text-right total">Sub Total</td>
            <td class="text-right">{{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-right">Diskon Total</td>
            <td class="text-right">{{ number_format($transaksi->total_diskon, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-right total">Total Bayar</td>
            <td class="text-right">{{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-right">Diterima</td>
            <td class="text-right">{{ number_format($transaksi->diterima, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-right">Kembali</td>
            <td class="text-right">{{ number_format($transaksi->diterima - $transaksi->bayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <br><br>
    <div class="center">
        <p>Terima kasih - Barang yang sudah dibeli tidak dapat dikembalikan</p>
    </div>

</body>
</html>
