<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\StatusPengajuan;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataStatusPengajuan = [
            [
                'namapengajuan' => 'Dalam antrian',
                'namapeminjaman' => 'Dalam antrian',
                'namaperbaikan' => 'Dalam antrian',
            ],
            [
                'namapengajuan' => 'Sedang digunakan',
                'namapeminjaman' => 'Sedang dipinjam',
                'namaperbaikan' => 'Sedang diperbaiki',
            ],
            [
                'namapengajuan' => 'Selesai',
                'namapeminjaman' => 'Selesai',
                'namaperbaikan' => 'Selesai',
            ],
        ];
        for ($i = 0; $i < count($dataStatusPengajuan); $i++) {
            $statusPengajuan = StatusPengajuan::create(
                $dataStatusPengajuan[$i]
            );
        }
    }
}
