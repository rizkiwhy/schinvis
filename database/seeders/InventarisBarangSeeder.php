<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\InventarisBarang;
use App\Models\InventarisTersedia;
use App\Models\InventarisDigunakan;
use App\Models\InventarisDiperbaiki;

class InventarisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInventarisBarang = [
            [
                'id' => 206020203001,
                'subsubkelompokbarang_id' => 206020203,
                'noregister' => 1,
                'merekmodel' => 'Quartz',
                'ukuran' => 40,
                'ukuranbarang_id' => 1,
                'bahanbarang_id' => 5,
                'kondisibarang_id' => 1,
                'tahunpembuatan' => 2021,
                'tanggalpembelian' => '2021-02-26',
                'statusbarang_id' => 1,
            ],
            [
                'id' => 206020203002,
                'subsubkelompokbarang_id' => 206020203,
                'noregister' => 2,
                'merekmodel' => 'Quartz',
                'ukuran' => 40,
                'ukuranbarang_id' => 1,
                'bahanbarang_id' => 5,
                'kondisibarang_id' => 1,
                'tahunpembuatan' => 2021,
                'tanggalpembelian' => '2021-02-26',
                'statusbarang_id' => 2,
            ],
            [
                'id' => 206020203003,
                'subsubkelompokbarang_id' => 206020203,
                'noregister' => 3,
                'merekmodel' => 'Quartz',
                'ukuran' => 40,
                'ukuranbarang_id' => 1,
                'bahanbarang_id' => 5,
                'kondisibarang_id' => 2,
                'tahunpembuatan' => 2021,
                'tanggalpembelian' => '2021-02-26',
                'statusbarang_id' => 3,
            ],
        ];
        for ($i = 0; $i < count($dataInventarisBarang); $i++) {
            $inventarisBarang = InventarisBarang::create(
                $dataInventarisBarang[$i]
            );
            // if ($inventarisBarang->statusbarang_id === 1) {
            //     $inventarisTersedia = InventarisTersedia::create([
            //         'inventarisbarang_id' => $inventarisBarang->id,
            //         'ruangan_id' => 9, // Harusnya ruangan_id gudang
            //     ]);
            // } else
            if ($inventarisBarang->statusbarang_id === 2) {
                $inventarisDigunakan = InventarisDigunakan::create([
                    'id' => substr(date('Ymd'), 2) . 1001000001,
                    'inventarisbarang_id' => $inventarisBarang->id,
                    'ruangan_id' => 1,
                    'user_id' => 1,
                    'jenispenggunaanbarang_id' => 1,
                    'mulaidigunakan' => date('Ymd'),
                ]);
            } elseif ($inventarisBarang->statusbarang_id === 3) {
                $inventarisDiperbaiki = InventarisDiperbaiki::create([
                    'id' =>
                        substr(date('Ymd'), 2) .
                        4 .
                        sprintf('%03s', 1) .
                        sprintf('%03s', 1),
                    'inventarisbarang_id' => $inventarisBarang->id,
                    'jenispengajuanbarang_id' => 4,
                    'statuspengajuan_id' => 1,
                    'user_id' => 1,
                    'masalah' => 'Tidak Berfungsi',
                ]);
            }
        }
    }
}
