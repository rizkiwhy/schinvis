<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisBarang;
use App\Models\PengajuanBarang;
use App\Models\InventarisDiperbaiki;
use App\Models\User;
use App\Models\Role;
use App\Models\StatusBarang;
use App\Models\StatusPengajuan;
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

    public function inventarisDiperbaikiDoughnut()
    {
        $labels = [];
        $dataInventarisDiperbaiki = [];
        $statusPengajuan = StatusPengajuan::all();
        for ($i = 0; $i < count($statusPengajuan); $i++) {
            array_push($labels, $statusPengajuan[$i]->namaperbaikan);
            array_push(
                $dataInventarisDiperbaiki,
                InventarisDiperbaiki::where(
                    'statuspengajuan_id',
                    $statusPengajuan[$i]->id
                )->count()
            );
        }
        return response()->json([
            'label' => $labels,
            'dataInventarisDiperbaiki' => $dataInventarisDiperbaiki,
        ]);
    }

    public function userPie()
    {
        $labels = [];
        $dataUser = [];
        $role = Role::all();
        for ($i = 0; $i < count($role); $i++) {
            array_push($labels, $role[$i]->nama);
            array_push(
                $dataUser,
                User::where('role_id', $role[$i]->id)->count()
            );
        }
        return response()->json([
            'label' => $labels,
            'dataUser' => $dataUser,
        ]);
    }

    public function inventarisBarangDoughnut()
    {
        $labels = [];
        $dataInventarisBarang = [];
        $statusBarang = StatusBarang::all();
        for ($i = 0; $i < count($statusBarang); $i++) {
            array_push($labels, $statusBarang[$i]->nama);
            array_push(
                $dataInventarisBarang,
                InventarisBarang::where(
                    'statusbarang_id',
                    $statusBarang[$i]->id
                )->count()
            );
        }
        return response()->json([
            'label' => $labels,
            'dataInventarisBarang' => $dataInventarisBarang,
        ]);
    }
    public function pengajuanBarangBar()
    {
        $labels = [];
        $dataPengajuanAlatKerja = [];
        $dataPengajuanPeminjaman = [];
        $dataPengajuanPermintaan = [];

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
