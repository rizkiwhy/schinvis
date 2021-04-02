<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\JenisPengajuanBarang;

class JenisPengajuanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataJenisPengajuanBarang = [
            ['nama' => 'Alat Kerja'],
            ['nama' => 'Peminjaman Barang'],
            ['nama' => 'Permintaan Barang'],
            ['nama' => 'Perbaikan Barang'],
        ];

        for ($i = 0; $i < count($dataJenisPengajuanBarang); $i++) {
            $jenisPengajuanBarang = JenisPengajuanBarang::create(
                $dataJenisPengajuanBarang[$i]
            );
        }
    }
}
