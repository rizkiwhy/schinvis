<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Title;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataTitle = [
            [
                'nama' => 'Pegawai',
                'aktif' => 1,
            ],
            [
                'nama' => 'Siswa',
                'aktif' => 1,
            ],
        ];
        for ($i = 0; $i < count($dataTitle); $i++) {
            Title::create($dataTitle[$i]);
        }
    }
}
