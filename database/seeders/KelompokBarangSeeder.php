<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\KelompokBarang;

class KelompokBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKelompokBarang = [
            [
                'id' => 20402,
                'nama' => 'Alat Bengkel Tak Bermesin',
                'bidangbarang_id' => 204,
            ],
            [
                'id' => 20403,
                'nama' => 'Alat Ukur',
                'bidangbarang_id' => 204,
            ],
            [
                'id' => 20601,
                'nama' => 'Alat Kantor',
                'bidangbarang_id' => 206,
            ],
            [
                'id' => 20602,
                'nama' => 'Alat Rumah Tangga',
                'bidangbarang_id' => 206,
            ],
            [
                'id' => 20603,
                'nama' => 'Alat Komputer',
                'bidangbarang_id' => 206,
            ],
            [
                'id' => 20604,
                'nama' => 'Alat Meja dan Kursi Kerja/Rapat Pejabat',
                'bidangbarang_id' => 206,
            ],
            [
                'id' => 20701,
                'nama' => 'Alat Studio',
                'bidangbarang_id' => 207,
            ],
            [
                'id' => 20702,
                'nama' => 'Alat Komunikasi',
                'bidangbarang_id' => 207,
            ],
            [
                'id' => 20901,
                'nama' => 'Unit-Unit Laboratorium',
                'bidangbarang_id' => 209,
            ],
            [
                'id' => 51801,
                'nama' => 'Barang Bercorak Kebudayaan',
                'bidangbarang_id' => 518,
            ],
        ];
        for ($i = 0; $i < count($dataKelompokBarang); $i++) {
            $kelompokBarang = KelompokBarang::create($dataKelompokBarang[$i]);
        }
    }
}
