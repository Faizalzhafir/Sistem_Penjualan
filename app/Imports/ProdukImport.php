<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProdukImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithMultipleSheets
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
        //dd($row);
        
        $kategori = Kategori::where('nama', $row['kategori'] ?? '')->first();
        // Ambil atau generate kode produk
        $kode = !empty($row['kode']) ? $row['kode'] : $this->generateKodeProduk($kategori?->nama ?? 'XXX');
        
        //\Log::info('Impor produk:', $row);
        return new Produk([
            'kategori_id'=> $kategori?->id,
            'kode' => $kode,
            'nama'  => $row['nama'],
            'berat'   => $row['berat'],
            'harga_beli'     => $row['harga_beli'],
            'harga_jual'     => $row['harga_jual'],
            'diskon'     => $row['diskon'],
            'stok'     => $row['stok'],
            'image' => $this->handleImage($row['image']),
        ]);

    }

    protected function generateKodeProduk($nama_kategori)
    {
        $kategori = Kategori::where('nama', $nama_kategori)->first();
        $prefix = strtoupper(substr($kategori->nama ?? 'XXX', 0, 3));
        $prefix = str_pad($prefix, 3, 'X');

        $lastKode = Produk::where('kode', 'like', "$prefix%")
            ->orderByDesc('kode')
            ->value('kode');

        $lastNumber = 0;
        if ($lastKode && preg_match("/{$prefix}(\d+)/", $lastKode, $matches)) {
            $lastNumber = intval($matches[1]);
        }

        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        return $prefix . $newNumber;
    }

    protected function handleImage($imageUrl)
    {
        //\Log::info('Proses image:', ['url' => $imageUrl]);

        // Jika image kosong, kembalikan default
        if (empty($imageUrl)) {
            return 'default.jpg';
        }

        // Cek apakah URL valid
        if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            // Ambil nama file dari URL
            $imageName = basename(parse_url($imageUrl, PHP_URL_PATH));
            $destinationPath = public_path('images/produk/' . $imageName);

            try {
                // Salin dari URL ke folder baru
                file_put_contents($destinationPath, file_get_contents($imageUrl));
                //\Log::info("Gambar berhasil disimpan: " . $imageName);
                return $imageName;
            } catch (\Exception $e) {
                \Log::error("Gagal download gambar: " . $e->getMessage());
                return 'default.jpg';
            }
        }

        // Jika bukan URL valid
        return 'default.jpg';

    }


    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255', 'unique:tb_produk,nama'],
            'berat' => ['required', 'string', 'max:25'],
            'harga_jual' => ['required', 'integer'],
            'harga_beli' => ['required', 'integer'],
            'diskon' => ['nullable', 'integer'],
            'stok' => ['required', 'integer'],
            'image' => ['nullable', 'string']
        ];
    }
}
