<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisDigunakan;
use App\Models\InventarisBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\PengajuanBarang;

class PermintaanController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Permintaan Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->baranghabispakai()
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbaranghabispakai()
            ->dalamantrian()
            ->get();

        $data['inventarisTersedia'] = DB::table('inventarisbarang')
            ->join(
                'subsubkelompokbarang',
                'inventarisbarang.subsubkelompokbarang_id',
                '=',
                'subsubkelompokbarang.id'
            )
            ->where('inventarisbarang.statusbarang_id', 1)
            ->select(
                'subsubkelompokbarang.id',
                'subsubkelompokbarang.nama',
                DB::raw(
                    'count(inventarisbarang.subsubkelompokbarang_id) as jumlah'
                )
            )
            ->groupBy('subsubkelompokbarang.id')
            ->get();

        $data['ruangan'] = Ruangan::all();
        $data['user'] = User::all();

        return view('pages.gudang.permintaan.index', compact('data'));
    }

    public function indexPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Permintaan Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->where('user_id', Auth::user()->id)
            ->baranghabispakai()
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbaranghabispakai()
            ->dalamantrian()
            ->where('user_id', Auth::user()->id)
            ->get();

        $data['inventarisTersedia'] = DB::table('inventarisbarang')
            ->join(
                'subsubkelompokbarang',
                'inventarisbarang.subsubkelompokbarang_id',
                '=',
                'subsubkelompokbarang.id'
            )
            ->where('inventarisbarang.statusbarang_id', 1)
            ->select(
                'subsubkelompokbarang.id',
                'subsubkelompokbarang.nama',
                DB::raw(
                    'count(inventarisbarang.subsubkelompokbarang_id) as jumlah'
                )
            )
            ->groupBy('subsubkelompokbarang.id')
            ->get();

        $data['ruangan'] = Ruangan::all();
        $data['user'] = User::all();

        return view('pages.transaksi.permintaan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
            'ruangan_id' => 'required',
            'user_id' => 'required',
        ]);

        // dd($request->all());

        $jumlahAwal = InventarisDigunakan::count();

        $jumlahInventarisTersedia = InventarisBarang::tersedia()
            ->where(
                'subsubkelompokbarang_id',
                $request->subsubkelompokbarang_id
            )
            ->count();
        if ($jumlahInventarisTersedia < $request->jumlahbarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.index')
                    ->with(
                        'error_message',
                        'Jumlah inventaris tersedia tidak mencukupi jumlah permintaan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.gudang.permintaan.index')
                    ->with(
                        'error_message',
                        'Jumlah inventaris tersedia tidak mencukupi jumlah permintaan!'
                    );
            }
        } else {
            for ($i = 0; $i < $request->jumlahbarang; $i++) {
                if ($request->pengajuanbarang_id === null) {
                    $noPengajuan = 000;
                } else {
                    $noPengajuan = substr($request->pengajuanbarang_id, -3);
                }
                $id = DB::table('inventarisdigunakan')
                    ->where('jenispenggunaanbarang_id', 3)
                    ->whereDate('created_at', date('Y-m-d'))
                    // ->max(DB::raw('substring(id, -3, 3)')); // mysql
                    ->max(DB::raw('substring(id::text, 14)')); // pgsql

                if ($id === null) {
                    $id = 1;
                } else {
                    $id = ++$id;
                }

                $id = substr($id, -3);
                // dd($id);
                $inventarisBarang = InventarisBarang::where(
                    'statusbarang_id',
                    1
                )->first();
                $inventarisBarang->update([
                    'statusbarang_id' => 2,
                ]);
                // $inventarisTersedia = InventarisTersedia::where(
                //     'inventarisbarang_id',
                //     $inventarisBarang->id
                // )->delete();

                $inventarisDigunakan = InventarisDigunakan::create([
                    'id' =>
                        substr(date('Ymd'), 2) .
                        2 .
                        sprintf('%03s', $request->user_id) .
                        sprintf('%03s', $noPengajuan) .
                        sprintf('%03s', $id),
                    'mulaidigunakan' => date('Ymd'),
                    'selesaidigunakan' => date('Ymd'),
                    'nopengajuan' => $request->pengajuanbarang_id,
                    'inventarisbarang_id' => $inventarisBarang->id,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                    'jenispenggunaanbarang_id' => 3,
                ]);
            }
            if (!empty($request->pengajuanbarang_id)) {
                $pengajuanBarang = PengajuanBarang::find(
                    $request->pengajuanbarang_id
                )->update([
                    'statuspengajuan_id' => 3,
                ]);
            }
        }

        $jumlahAkhir = InventarisDigunakan::count();

        if ($jumlahAkhir === $jumlahAwal + $request->jumlahbarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil didistribusikan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.gudang.permintaan.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil didistribusikan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal didistribusikan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.gudang.permintaan.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal didistribusikan!'
                    );
            }
        }
    }
}
