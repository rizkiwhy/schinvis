<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanBarang;
use App\Models\InventarisBarang;
use App\Models\InventarisDigunakan;
use App\Models\InventarisTersedia;
use App\Models\Ruangan;
use App\Models\User;

class DistribusiBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Distribusi';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->alatkerja()
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbarang()
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

        return view('pages.gudang.distribusi.index', compact('data'));
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
                    ->route('admin.gudang.distribusi.index')
                    ->with(
                        'error_message',
                        'Jumlah inventaris tersedia tidak mencukupi jumlah permintaan!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.index')
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
                    ->where('jenispenggunaanbarang_id', 1)
                    ->whereDate('created_at', date('Y-m-d'))
                    // ganti max('noregister')
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

                $inventarisDigunakan = InventarisDigunakan::create([
                    'id' =>
                        substr(date('Ymd'), 2) .
                        1 .
                        sprintf('%03s', $request->user_id) .
                        sprintf('%03s', $noPengajuan) .
                        sprintf('%03s', $id),
                    'mulaidigunakan' => date('Ymd'),
                    'nopengajuan' => $request->pengajuanbarang_id,
                    'inventarisbarang_id' => $inventarisBarang->id,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                    'jenispenggunaanbarang_id' => 1,
                ]);
                $inventarisBarang->update([
                    'statusbarang_id' => 2,
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
                    ->route('admin.gudang.distribusi.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil didistribusikan!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil didistribusikan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal didistribusikan!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal didistribusikan!'
                    );
            }
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Distribusi';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::find($id);
        $data['ruangan'] = Ruangan::all();
        $data['user'] = User::all();
        return view('pages.gudang.distribusi.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'ruangan_id' => 'required',
            'user_id' => 'required',
        ]);

        $inventarisDigunakan = InventarisDigunakan::find($request->id);

        $inventarisDigunakan->update([
            'ruangan_id' => $request->ruangan_id,
            'user_id' => $request->user_id,
            'inventarisbarang_id' => $request->inventarisbarang_id,
        ]);

        $inventarisDigunakan->update([
            'id' => substr_replace(
                $inventarisDigunakan->id,
                sprintf('%03s', $request->user_id) .
                    substr($inventarisDigunakan->id, -6),
                7
            ),
        ]);

        if ($inventarisDigunakan) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.edit', [
                        'id' => $request->id,
                    ])
                    ->with('error_message', 'Data inventaris gagal diubah!');
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.edit', [
                        'id' => $request->id,
                    ])
                    ->with('error_message', 'Data inventaris gagal diubah!');
            }
        }
    }

    public function end(Request $request)
    {
        // dd($request->all());
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
                    ->route('admin.gudang.distribusi.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.index')
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
                    ->route('admin.gudang.distribusi.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' gagal disimpan!'
                    );
            } else {
                return redirect()
                    ->route('manajemen.gudang.distribusi.edit', [
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
