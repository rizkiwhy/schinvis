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
        $dataPengajuan = [];
        $dataDistribusi = [];

        for ($i = 0; $i < 7; $i++) {
            array_push($labels, date('j-M', strtotime('- ' . $i . ' days')));
            array_push(
                $dataPengajuan,
                DB::table('pengajuanbarang')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->sum('jumlahbarang')
            );
            array_push(
                $dataDistribusi,
                DB::table('inventarisdigunakan')
                    // ->whereNotNull('nopengajuan')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->count('nopengajuan')
            );
        }

        return response()->json(
            [
                'label' => array_reverse($labels),
                'dataPengajuan' => array_reverse($dataPengajuan),
                'dataDistribusi' => array_reverse($dataDistribusi),
            ]
            // ['dataPengajuan' => array_reverse($dataPengajuan)],
            // ['dataDistribusi' => array_reverse($dataDistribusi)],
        );
    }
}
