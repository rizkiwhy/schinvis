<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisBarang;
use App\Models\PengajuanBarang;
use App\Models\InventarisDiperbaiki;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Dashboard';
        $data['app'] = 'Assek App';

        $data['totalInventarisBarang'] = InventarisBarang::count();
        $data['totalPengajuanBarang'] =
            PengajuanBarang::where('statuspengajuan_id', 1)->count() +
            InventarisDiperbaiki::where('statuspengajuan_id', 1)->count();
        $data['totalUser'] = User::where('id', '<>', 1)->count();
        $data['totalInventarisRusak'] = InventarisBarang::where(
            'kondisibarang_id',
            '<>',
            1
        )->count();

        return view('pages.welcome', compact('data'));
    }

    public function pengajuanBarangStackedBar()
    {
        $labels = [];
        $dataPengajuanAlatKerja = [];
        $dataPengajuanPeminjaman = [];
        $dataPengajuanPermintaan = [];
        // $dataDistribusi = [];

        for ($i = 0; $i < 7; $i++) {
            array_push($labels, date('j-M', strtotime('- ' . $i . ' days')));
            array_push(
                $dataPengajuanAlatKerja,
                DB::table('pengajuanbarang')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('jenispengajuanbarang_id', 1)
                    ->sum('jumlahbarang')
            );
            array_push(
                $dataPengajuanPeminjaman,
                DB::table('pengajuanbarang')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('jenispengajuanbarang_id', 2)
                    ->sum('jumlahbarang')
            );
            array_push(
                $dataPengajuanPermintaan,
                DB::table('pengajuanbarang')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('jenispengajuanbarang_id', 3)
                    ->sum('jumlahbarang')
            );
            // array_push(
            //     $dataDistribusi,
            //     DB::table('inventarisdigunakan')
            //         // ->whereNotNull('nopengajuan')
            //         ->whereDate(
            //             'created_at',
            //             date('Y-m-d', strtotime('- ' . $i . ' days'))
            //         )
            //         ->count('nopengajuan')
            // );
        }

        return response()->json([
            'label' => array_reverse($labels),
            'dataPengajuanAlatKerja' => array_reverse($dataPengajuanAlatKerja),
            'dataPengajuanPeminjaman' => array_reverse(
                $dataPengajuanPeminjaman
            ),
            'dataPengajuanPermintaan' => array_reverse(
                $dataPengajuanPermintaan
            ),
        ]);
    }
}
