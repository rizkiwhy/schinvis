<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BidangBarang;

class BidangBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataBidangBarang = [
            ['id' => '101', 'nama' => 'Tanah', 'golonganbarang_id' => '1'],
            [
                'id' => '202',
                'nama' => 'Alat-Alat Besar',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '203',
                'nama' => 'Alat-Alat Angkutan',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '204',
                'nama' => 'Alat Bengkel dan Alat Ukur',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '205',
                'nama' => 'Alat Pertanian',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '206',
                'nama' => 'Alat Kantor dan Rumah Tangga',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '207',
                'nama' => 'Alat Studio dan Alat Komunikasi',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '208',
                'nama' => 'Alat-Alat Kedokteran',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '209',
                'nama' => 'Alat Laboratorium',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '210',
                'nama' => 'Alat-Alat Persenjataan/Keamanan',
                'golonganbarang_id' => '2',
            ],
            [
                'id' => '311',
                'nama' => 'Bangungan Gedung',
                'golonganbarang_id' => '3',
            ],
            ['id' => '312', 'nama' => 'Monumen', 'golonganbarang_id' => '3'],
            [
                'id' => '413',
                'nama' => 'Jalan dan Jembatan',
                'golonganbarang_id' => '4',
            ],
            [
                'id' => '414',
                'nama' => 'Bangunan Air/Irigasi',
                'golonganbarang_id' => '4',
            ],
            ['id' => '415', 'nama' => 'Instalasi', 'golonganbarang_id' => '4'],
            ['id' => '416', 'nama' => 'Jaringan', 'golonganbarang_id' => '4'],
            [
                'id' => '517',
                'nama' => 'Buku dan Perpustakaan',
                'golonganbarang_id' => '5',
            ],
            [
                'id' => '518',
                'nama' => 'Barang Bercorak Kebudayaan',
                'golonganbarang_id' => '5',
            ],
            [
                'id' => '519',
                'nama' => 'Hewan dan Ternak serta Tanaman',
                'golonganbarang_id' => '5',
            ],
        ];
        for ($i = 0; $i < count($dataBidangBarang); $i++) {
            $bidangBarang = BidangBarang::create($dataBidangBarang[$i]);
        }
    }
}
