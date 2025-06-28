<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProdukTemplate implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new class implements FromArray, WithTitle {
                public function array(): array
                {
                    return [
                        ['Kategori', 'Nama', 'Kode', 'Berat', 'Harga Beli', 'Harga Jual', 'Diskon', 'Stok', 'Image'], // Sheet 1: hanya header
                    ];
                }

                public function title(): string
                {
                    return 'Template';
                }
            },

            new class implements FromArray, WithTitle {
                public function array(): array
                {
                    return [
                        ['Keterangan'],
                        ['* Isi nama kolom sesuai dengan referensi yang berlaku'],
                        ['* Kolom yang memiliki relasi ke tabel referensi:'],
                        ['- Kategori (tabel: tb_kategori)'],
                        ['- Kolom image diisi dengan link atau nama path gambar seuai dengan gambar yang inign ditambahkan'],
                        ['- Kolom kode dikosongkan, karena akan dibuatkan otomatis oleh sistem'],
                    ];
                }

                public function title(): string
                {
                    return 'Keterangan';
                }
            }
        ];
    }
}
