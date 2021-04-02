<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKelamin;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataJenisKelamin = [
            [
                'nama' => 'Laki-Laki',
            ],
            [
                'nama' => 'Perempuan',
            ],
        ];
        for ($i = 0; $i < count($dataJenisKelamin); $i++) {
            JenisKelamin::create($dataJenisKelamin[$i]);
        }
    }
}
