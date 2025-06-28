<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class KategoriTemplate implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new class implements FromArray, WithTitle {
                public function array(): array
                {
                    return [
                        ['Nama Kategori'], // Sheet 1: hanya header
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
                        ['* Nama Katgeori akan digunakan untuk jadi kata kunci di Kode Produk nantinya'],
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
