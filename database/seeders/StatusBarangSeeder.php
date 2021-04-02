<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\StatusBarang;

class StatusBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataStatusBarang = [
            ['nama' => 'Disimpan'],
            ['nama' => 'Digunakan'],
            ['nama' => 'Diperbaiki'],
        ];
        for ($i = 0; $i < count($dataStatusBarang); $i++) {
            $statusBarang = StatusBarang::create(
                $dataStatusBarang[$i]
            );
        }
    }
}
