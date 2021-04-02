<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\KondisiBarang;

class KondisiBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKondisiBarang = [
            ['nama' => 'Baik'],
            ['nama' => 'Kurang Baik'],
            ['nama' => 'Rusak Berat'],
        ];
        for ($i = 0; $i < count($dataKondisiBarang); $i++) {
            $kondisiBarang = KondisiBarang::create($dataKondisiBarang[$i]);
        }
    }
}
