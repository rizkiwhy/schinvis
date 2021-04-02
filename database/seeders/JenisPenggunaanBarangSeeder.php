<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\JenisPenggunaanBarang;

class JenisPenggunaanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataJenisPenggunaanBarang = [
            ['nama' => 'Alat Kerja'],
            ['nama' => 'Peminjaman'],
            ['nama' => 'Barang Habis Pakai'],
        ];

        for ($i = 0; $i < count($dataJenisPenggunaanBarang); $i++) {
            $jenisPenggunaanBarang = JenisPenggunaanBarang::create(
                $dataJenisPenggunaanBarang[$i]
            );
        }
    }
}
