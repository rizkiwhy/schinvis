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
use App\Models\JenisPengajuanBarang;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Dashboard';
        $data['app'] = 'Assek App';

        $data['totalInventarisBarang'] = InventarisBarang::count();
        $data[
            'totalPengajuanBarang'
        ] = PengajuanBarang::dalamantrian()->count();
        // InventarisDiperbaiki::where('statuspengajuan_id', 1)->count();
        $data['totalUser'] = User::where('id', '<>', 1)->count();
        $data['totalInventarisRusak'] = InventarisBarang::where(
            'kondisibarang_id',
            '<>',
            1
        )->count();

        return view('pages.welcome', compact('data'));
    }

    public function inventarisDiperbaikiBar()
    {
        $labels = [];
        $dataInventarisDiperbaikiDalamAntrian = [];
        $dataInventarisDiperbaikiSedangDiperbaiki = [];
        $dataInventarisDiperbaikiSelesaiDiperbaiki = [];

        $statusPengajuan = StatusPengajuan::all();

        for ($i = 0; $i < 7; $i++) {
            array_push($labels, date('j-M', strtotime('- ' . $i . ' days')));
            array_push(
                $dataInventarisDiperbaikiDalamAntrian,
                DB::table('inventarisdiperbaiki')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('statuspengajuan_id', 1)
                    ->count()
            );
            array_push(
                $dataInventarisDiperbaikiSedangDiperbaiki,
                DB::table('inventarisdiperbaiki')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('statuspengajuan_id', 2)
                    ->count()
            );
            array_push(
                $dataInventarisDiperbaikiSelesaiDiperbaiki,
                DB::table('inventarisdiperbaiki')
                    ->whereDate(
                        'created_at',
                        date('Y-m-d', strtotime('- ' . $i . ' days'))
                    )
                    ->where('statuspengajuan_id', 3)
                    ->count()
            );
        }

        return response()->json([
            'label' => array_reverse($labels),
            'dataInventarisDiperbaikiDalamAntrian' => array_reverse(
                $dataInventarisDiperbaikiDalamAntrian
            ),
            'dataInventarisDiperbaikiSedangDiperbaiki' => array_reverse(
                $dataInventarisDiperbaikiSedangDiperbaiki
            ),
            'dataInventarisDiperbaikiSelesaiDiperbaiki' => array_reverse(
                $dataInventarisDiperbaikiSelesaiDiperbaiki
            ),
        ]);
    }

    public function pengajuanBarangPie()
    {
        $labels1 = [];
        $labels2 = [];
        $labels3 = [];
        $data = [];
        $dataPengajuanAlatKerja = [];
        $dataPengajuanPeminjaman = [];
        $dataPengajuanPermintaan = [];

        $statusPengajuan = StatusPengajuan::all();
        $jenisPengajuanBarang = JenisPengajuanBarang::where(
            'id',
            '<>',
            4
        )->get();

        for ($i = 0; $i < count($jenisPengajuanBarang); $i++) {
            for ($j = 0; $j < count($statusPengajuan); $j++) {
                if ($jenisPengajuanBarang[$i]->id === 1) {
                    if ($statusPengajuan[$j]->id !== 2) {
                        array_push(
                            $labels1,
                            ucwords($statusPengajuan[$j]->namapengajuan)
                        );
                    }
                } elseif ($jenisPengajuanBarang[$i]->id === 2) {
                    array_push(
                        $labels2,
                        ucwords($statusPengajuan[$j]->namapeminjaman)
                    );
                } elseif ($jenisPengajuanBarang[$i]->id === 3) {
                    if ($statusPengajuan[$j]->id !== 2) {
                        array_push(
                            $labels3,
                            ucwords($statusPengajuan[$j]->namapengajuan)
                        );
                    }
                }

                array_push(
                    $data,
                    PengajuanBarang::where([
                        [
                            'jenispengajuanbarang_id',
                            $jenisPengajuanBarang[$i]->id,
                        ],
                        ['statuspengajuan_id', $statusPengajuan[$j]->id],
                    ])->count()
                );
            }
        }
        for ($k = 0; $k < count($data); $k++) {
            if ($k <= 2) {
                array_push($dataPengajuanAlatKerja, $data[$k]);
            } elseif ($k <= 5) {
                array_push($dataPengajuanPeminjaman, $data[$k]);
            } elseif ($k <= 8) {
                array_push($dataPengajuanPermintaan, $data[$k]);
            }
        }
        return response()->json([
            'label' => $labels1,
            'label' => $labels1,
            'label' => $labels1,
            'dataPengajuanAlatKerja' => $dataPengajuanAlatKerja,
            'dataPengajuanPeminjaman' => $dataPengajuanPeminjaman,
            'dataPengajuanPermintaan' => $dataPengajuanPermintaan,
        ]);
    }

    public function inventarisBarangBar()
    {
        $labels = [];
        $dataInventarisBarang = [];

        $inventarisBarang = DB::table('inventarisbarang')
            ->join(
                'subsubkelompokbarang',
                'inventarisbarang.subsubkelompokbarang_id',
                '=',
                'subsubkelompokbarang.id'
            )
            ->select(
                DB::raw(
                    'count(inventarisbarang.subsubkelompokbarang_id) as jumlah'
                ),
                'subsubkelompokbarang.nama'
            )
            ->orderByDesc('jumlah')
            ->groupBy('subsubkelompokbarang.nama')
            ->limit(5)
            ->get();

        for ($i = 0; $i < count($inventarisBarang); $i++) {
            array_push($labels, $inventarisBarang[$i]->nama);
            array_push($dataInventarisBarang, $inventarisBarang[$i]->jumlah);
        }

        return response()->json([
            'label' => $labels,
            'dataInventarisBarang' => $dataInventarisBarang,
        ]);
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
