<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRuangan = [
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Kepala Sekolah',
                'luas' => '6x4',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Meeting 2',
                'luas' => '5.5x3.5',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Data',
                'luas' => '4.5x3',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Hubin',
                'luas' => '7x5.5',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Tata Usaha',
                'luas' => '9x8',
                'koridor_depan' => '9x3',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Tata Usaha (Kosong)',
                'luas' => '0x0',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Manajemen',
                'luas' => '9x8',
                'koridor_depan' => '9x3',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Meeting 1',
                'luas' => '9x8',
                'koridor_depan' => '9x3',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Pantry',
                'luas' => '4x3',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Toilet 1',
                'luas' => '4x3',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruangan Toilet 1 (Kosong)',
                'luas' => '0x0',
                'koridor_depan' => '0x0',
                'koridor_belakang' => '0x0',
            ],
        ];
        for ($i = 0; $i < count($dataRuangan); $i++) {
            $ruangan = Ruangan::create($dataRuangan[$i]);
        }
    }
}
