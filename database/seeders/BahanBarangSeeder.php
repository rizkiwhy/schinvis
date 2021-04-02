<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BahanBarang;

class BahanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataBahanBarang = [
            ['nama' => 'Kayu'],
            ['nama' => 'Kaca'],
            ['nama' => 'Kertas'],
            ['nama' => 'Besi'],
            ['nama' => 'Plastik'],
            ['nama' => 'Alumunium'],
            ['nama' => 'Mika'],
            ['nama' => 'Baja'],
            ['nama' => 'Triplek'],
            ['nama' => 'Karet'],
        ];
        for ($i = 0; $i < count($dataBahanBarang); $i++) {
            $bahanBarang = BahanBarang::create($dataBahanBarang[$i]);
        }
    }
}
