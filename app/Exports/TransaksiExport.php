<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = Transaksi::with('user')->get();

        // Data transaksi baris per baris
        $rows = $data->map(function ($t) {
            return [
                'Kode Transaksi' => $t->kode_transaksi,
                'Tanggal' => $t->created_at->format('d-m-Y H:i'),
                'Nama Kasir' => $t->user->name,
                'Total' => $t->total,
                'Diskon' => $t->total_diskon,
                'Diterima' => $t->diterima,
                'Bayar' => $t->bayar,
                'Metode Pembayaran' => ucfirst($t->metode_pembayaran),
                'Status Pembayaran' => ucfirst($t->status_pembayaran),
            ];
        });

        // Baris kosong (opsional)
        $rows->push([
            'Kode Transaksi' => '',
            'Tanggal' => '',
            'Nama Kasir' => '',
            'Total' => '',
            'Diskon' => '',
            'Diterima' => '',
            'Bayar' => '',
            'Metode Pembayaran' => '',
            'Status Pembayaran' => '',
        ]);

        // Baris total
        $rows->push([
            'Kode Transaksi' => 'Total',
            'Tanggal' => '',
            'Nama Kasir' => '',
            'Total' => $data->sum('total'),
            'Diskon' => $data->sum('total_diskon'),
            'Diterima' => $data->sum('diterima'),
            'Bayar' => $data->sum('bayar'),
            'Metode Pembayaran' => '',
            'Status Pembayaran' => '',
        ]);

        return $rows;
    }


    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal',
            'Nama Kasir',
            'Total',
            'Diskon',
            'Diterima',
            'Bayar',
            'Metode Pembayaran',
            'Status Pembayaran'
        ];
    }
}

