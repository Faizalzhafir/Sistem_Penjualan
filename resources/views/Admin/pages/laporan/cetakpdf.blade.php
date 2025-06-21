<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Riwayat Transaksi - PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        h3 { text-align: center; color: black; background-color: lightblue;}
        h4.h4{ text-align: center; color: black; font-style: italic;}
        p { margin-top: 20px; }
        hr { color: light}
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; }
        th { background-color: lightblue; }
    </style>
</head>
<body>
    <h3>{{ $setting->nama_toko }}</h3>
    <h4 style="text-align: center; font-style: none;">Laporan Transaksi</h4>
    <h4 class="h4">{{ $setting->alamat }}</h4>
    <h4 class="h4">Telp : {{ $setting->telepon }} | Email : {{ $setting->email }}</h4>
    <hr>
    <p>Tanggal: {{ now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Diskon</th>
                <th>Diterima</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->total_diskon, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->diterima, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                    <td>{{ ucfirst($item->status_pembayaran) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total Transaksi:</th>
                <th>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($totalDiskon, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($totalDiterima, 0, ',', '.') }}</th>
                <th colspan="2"></th>
            </tr>
            <tr>
                <th colspan="9">Total Jumlah Transaksi : {{ $totalTransaksi }} Transaksi</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
