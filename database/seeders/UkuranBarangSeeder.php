<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UkuranBarang;

class UkuranBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataUkurangBarang = [
            ['nama' => 'cm'],
            ['nama' => 'm'],
            ['nama' => 'kg'],
            ['nama' => 'inch'],
        ];
        for ($i = 0; $i < count($dataUkurangBarang); $i++) {
            $ukuranBarang = UkuranBarang::create($dataUkurangBarang[$i]);
        }
    }
}
