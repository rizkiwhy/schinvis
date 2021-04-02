<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Gedung;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataGedung = [
            [
                'nama' => 'Bangunan Kantor',
                'kode' => 'A',
                'kelompok' => '1',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'B',
                'kelompok' => '2',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'C',
                'kelompok' => '2',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'D',
                'kelompok' => '3',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'E',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'F',
                'kelompok' => '4',
            ],
            [
                'nama' => 'Rumah Dinas',
                'kode' => 'G',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Bangunan Kantor',
                'kode' => 'H',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Pos Satpam',
                'kode' => 'I',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'J',
                'kelompok' => '5',
            ],
            [
                'nama' => 'Toilet',
                'kode' => 'K',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Bangunan Tempat Pendidikan',
                'kode' => 'L',
                'kelompok' => '5',
            ],
            [
                'nama' => 'Lapangan Upacara / Olahraga',
                'kode' => 'M',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Pintu Gerbang',
                'kode' => 'N',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 1',
                'kode' => 'O',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 2',
                'kode' => 'P',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 3',
                'kode' => 'Q',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 4',
                'kode' => 'R',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 5',
                'kode' => 'S',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Taman 6',
                'kode' => 'T',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Parkir Motor',
                'kode' => 'U',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Parkir Motor Guru dan Karyawan',
                'kode' => 'V',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Parkir Mobil',
                'kode' => 'W',
                'kelompok' => '6',
            ],
            [
                'nama' => 'Benteng',
                'kode' => 'X',
                'kelompok' => '6',
            ],
        ];
        for ($i = 0; $i < count($dataGedung); $i++) {
            $gedung = Gedung::create($dataGedung[$i]);
        }
    }
}
