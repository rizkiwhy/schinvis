<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\SubKelompokBarang;

class SubKelompokBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSubKelompokBarang = [
            [
                'id' => 2040207,
                'nama' => 'Perkakas Bengkel Kerja',
                'kelompokbarang_id' => 20402,
            ],
            [
                'id' => 2040308,
                'nama' => 'Alat Ukur Pembanding',
                'kelompokbarang_id' => 20403,
            ],
            [
                'id' => 2040310,
                'nama' => 'Alat Timbangan/Blora',
                'kelompokbarang_id' => 20403,
            ],
            [
                'id' => 2060102,
                'nama' => 'Mesin Hitung Jumlah',
                'kelompokbarang_id' => 20601,
            ],
            [
                'id' => 2060104,
                'nama' => 'Alat Penyimpanan Perlengkapan Kantor',
                'kelompokbarang_id' => 20601,
            ],
            [
                'id' => 2060105,
                'nama' => 'Alat Kantor Lainnya',
                'kelompokbarang_id' => 20601,
            ],
            [
                'id' => 2060201,
                'nama' => 'Meubelair',
                'kelompokbarang_id' => 20602,
            ],
            [
                'id' => 2060202,
                'nama' => 'Alat Pengukur Waktu',
                'kelompokbarang_id' => 20602,
            ],
            [
                'id' => 2060204,
                'nama' => 'Alat Pendingin',
                'kelompokbarang_id' => 20602,
            ],
            [
                'id' => 2060206,
                'nama' => 'Alat Rumah Tangga Lainnya (Home Use)',
                'kelompokbarang_id' => 20602,
            ],
            [
                'id' => 2060301,
                'nama' => 'Komputer Unit/Jaringan',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060302,
                'nama' => 'Personal Komputer',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060303,
                'nama' => 'Peralatan Komputer Mainframe',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060304,
                'nama' => 'Peralatan Mini Komputer',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060305,
                'nama' => 'Peralatan Personal Komputer',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060306,
                'nama' => 'Peralatan Jaringan',
                'kelompokbarang_id' => 20603,
            ],
            [
                'id' => 2060401,
                'nama' => 'Meja Kerja Pejabat',
                'kelompokbarang_id' => 20604,
            ],
            [
                'id' => 2060402,
                'nama' => 'Meja Rapat Pejabat',
                'kelompokbarang_id' => 20604,
            ],
            [
                'id' => 2060407,
                'nama' => 'Lemari dan Arsip Pejabat',
                'kelompokbarang_id' => 20604,
            ],
            [
                'id' => 2070101,
                'nama' => 'Peralatan Studio Visual',
                'kelompokbarang_id' => 20701,
            ],
            [
                'id' => 2070102,
                'nama' => 'Peralatan Studio Video dan Film',
                'kelompokbarang_id' => 20701,
            ],
            [
                'id' => 2070201,
                'nama' => 'Alat Komunikasi Telepon',
                'kelompokbarang_id' => 20702,
            ],
            [
                'id' => 2090101,
                'nama' => 'Alat Laboratorium Kimia Air',
                'kelompokbarang_id' => 20901,
            ],
            [
                'id' => 2090104,
                'nama' => 'Alat Laboratorium Model/Hidrolika',
                'kelompokbarang_id' => 20901,
            ],
            [
                'id' => 5180104,
                'nama' => 'Alat Olahraga',
                'kelompokbarang_id' => 51801,
            ],
        ];
        for ($i = 0; $i < count($dataSubKelompokBarang); $i++) {
            $subKelompokBarang = SubKelompokBarang::create(
                $dataSubKelompokBarang[$i]
            );
        }
    }
}
