<?php

namespace App\Imports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KategoriImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithMultipleSheets
{
    use SkipsFailures;

    public function sheets(): array
    {
        return [
            0 => $this, // hanya proses sheet ke-0 (pertama)
        ];
    }

    public function model(array $row)
    {
        return new Kategori([
            'nama' => $row['nama_kategori'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:tb_kategori,nama'],
        ];
    }
}
