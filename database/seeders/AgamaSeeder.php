<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agama;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAgama = [
            [
                'nama' => 'Islam',
            ],
            [
                'nama' => 'Kristen',
            ],
            [
                'nama' => 'Katolik',
            ],
            [
                'nama' => 'Hindu',
            ],
            [
                'nama' => 'Buddha',
            ],
            [
                'nama' => 'Lainnya',
            ],
        ];
        for ($i = 0; $i < count($dataAgama); $i++) {
            Agama::create($dataAgama[$i]);
        }
    }
}
