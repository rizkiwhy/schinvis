<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\GolonganBarang;

class GolonganBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataGolonganBarang = [
            ['nama' => 'Golongan Tanah'],
            ['nama' => 'Golongan Peralatan dan Mesin'],
            ['nama' => 'Golongan Gedung dan Bangunan'],
            ['nama' => 'Golongan Jalan, Irigasi dan Jaringan'],
            ['nama' => 'Golongan Asset Tetap Lainnya'],
            ['nama' => 'Golongan Konstruksi dalam Pengerjaan'],
        ];

        for ($i = 0; $i < count($dataGolonganBarang); $i++) {
            $golonganBarang = GolonganBarang::create($dataGolonganBarang[$i]);
        }
    }
}
