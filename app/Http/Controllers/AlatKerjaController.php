<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InventarisDigunakan;
use App\Models\InventarisBarang;
use App\Models\PengajuanBarang;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlatKerjaController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Alat Kerja';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->where([
                ['user_id', Auth::user()->id],
                ['jenispenggunaanbarang_id', 1],
            ])
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::dalamantrian()->get();
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

        return view('pages.alat-kerja.index', compact('data'));
    }

    public function end(Request $request)
    {
        $inventarisBarang = InventarisBarang::find(
            $request->end_inventarisbarang_id
        );
        $inventarisBarang->update([
            'statusbarang_id' => 1,
        ]);
        $inventarisDigunakan = InventarisDigunakan::find($request->end_id);
        $inventarisDigunakan->update([
            'selesaidigunakan' => date('Ymd'),
        ]);

        if ($inventarisDigunakan) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('manajemen.alat-kerja.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.index', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' gagal disimpan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.index', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' gagal disimpan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('manajemen.alat-kerja.index', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' gagal disimpan!'
                    );
            }
        }
    }
}
