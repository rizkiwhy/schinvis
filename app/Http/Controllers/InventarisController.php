<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\InventarisDigunakan;
use App\Models\InventarisBarang;
use App\Models\SubSubKelompokBarang;
use App\Models\UkuranBarang;
use App\Models\BahanBarang;
use App\Models\KondisiBarang;
use App\Models\StatusBarang;

class InventarisController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Inventaris';
        $data['app'] = 'Assek App';

        $data['inventaris'] = InventarisBarang::with([
            'subSubKelompokBarang',
            'ukuranBarang',
            'bahanBarang',
            'kondisiBarang',
            'statusBarang',
        ])->get();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['ukuranBarang'] = UkuranBarang::all();
        $data['bahanBarang'] = BahanBarang::all();
        $data['kondisiBarang'] = KondisiBarang::all();
        $data['statusBarang'] = StatusBarang::first();

        return view('pages.gudang.inventaris.index', compact('data'));
    }

    public function indexDigunakanPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Inventaris Digunakan';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang',
            'jenisPenggunaanBarang',
            'ruangan',
            'user',
        ])
            ->whereNull('selesaidigunakan')
            ->pribadi()
            ->whereNotIn('jenispenggunaanbarang_id', [3])
            ->get();

        return view('pages.inventaris.digunakan..index', compact('data'));
    }

    public function endDigunakanPribadi(Request $request)
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
                    ->route('admin.inventaris.digunakan.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.inventaris.digunakan.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $request->end_inventarisbarang_id .
                            ' berhasil disimpan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.inventaris.digunakan.index')
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
                    ->route('admin.inventaris.digunakan.index', [
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
                    ->route('user.inventaris.digunakan.index', [
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
                    ->route('management.inventaris.digunakan.index', [
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

    public function indexBarangHabisPakaiPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Inventaris Barang Habis Pakai';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang',
            'jenisPenggunaanBarang',
            'ruangan',
            'user',
        ])
            ->whereNull('selesaidigunakan')
            ->pribadi()
            ->where('jenispenggunaanbarang_id', 3)
            ->get();

        return view('pages.inventaris.baranghabispakai.index', compact('data'));
    }

    public function checkNoRegister(Request $request)
    {
        $data['lastNoRegister'] = DB::table('inventarisbarang')
            ->where(
                'subsubkelompokbarang_id',
                $request->subsubkelompokbarang_id
            )
            ->max('noregister');
        $data['newNoRegister'] = sprintf('%03s', ++$data['lastNoRegister']);

        return response()->json($data['newNoRegister']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'noregisterhidden' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'merekmodel' => 'required',
            'ukuran' => 'required',
            'ukuranbarang_id' => 'required',
            'bahanbarang_id' => 'required',
            'tahunpembuatan' => 'required',
            'tanggalpembelian' => 'required',
            'kondisibarang_id' => 'required',
            'statusbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $jumlahAwal = InventarisBarang::count();

        $noRegister = substr($request->noregisterhidden, -3);

        // dd($noRegister);

        for ($i = 0; $i < $request->jumlahbarang; $i++) {
            $inventarisBarang = InventarisBarang::create([
                'id' =>
                    $request->subsubkelompokbarang_id .
                    sprintf('%03s', $noRegister),
                // $noRegister,
                'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
                'noregister' => $noRegister,
                'merekmodel' => $request->merekmodel,
                'noseri' => $request->noseri,
                'ukuran' => $request->ukuran,
                'ukuranbarang_id' => $request->ukuranbarang_id,
                'bahanbarang_id' => $request->bahanbarang_id,
                'tahunpembuatan' => $request->tahunpembuatan,
                'tanggalpembelian' => $request->tanggalpembelian,
                'kondisibarang_id' => $request->kondisibarang_id,
                'statusbarang_id' => $request->statusbarang_id,
            ]);
            // $inventarisTersedia = InventarisTersedia::create([
            //     'inventarisbarang_id' => $inventarisBarang->id,
            //     'ruangan_id' => 9,
            // ]);

            $noRegister++;
        }

        $jumlahAkhir = InventarisBarang::count();

        if ($jumlahAkhir === $jumlahAwal + $request->jumlahbarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal ditambahkan!'
                    );
            }
        }
    }

    public function destroy(Request $request)
    {
        $inventarisBarang = InventarisBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($inventarisBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.index')
                    ->with('error_message', 'Data inventaris gagal dihapus!');
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.index')
                    ->with('error_message', 'Data inventaris gagal dihapus!');
            }
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Inventaris';
        $data['app'] = 'Assek App';

        $data['inventaris'] = InventarisBarang::find($id);
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['ukuranBarang'] = UkuranBarang::all();
        $data['bahanBarang'] = BahanBarang::all();
        $data['kondisiBarang'] = KondisiBarang::all();
        $data['statusBarang'] = StatusBarang::all();
        return view('pages.gudang.inventaris.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'noregisterhidden' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'merekmodel' => 'required',
            'ukuran' => 'required',
            'ukuranbarang_id' => 'required',
            'bahanbarang_id' => 'required',
            'tahunpembuatan' => 'required',
            'tanggalpembelian' => 'required',
            'kondisibarang_id' => 'required',
            'statusbarang_id' => 'required',
        ]);

        $noRegister = substr($request->noregisterhidden, -3);

        $inventaris = InventarisBarang::find($request->id);
        $inventaris->update([
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'noregister' => $noRegister,
            'merekmodel' => $request->merekmodel,
            'noseri' => $request->noseri,
            'ukuran' => $request->ukuran,
            'ukuranbarang_id' => $request->ukuranbarang_id,
            'bahanbarang_id' => $request->bahanbarang_id,
            'tahunpembuatan' => $request->tahunpembuatan,
            'tanggalpembelian' => $request->tanggalpembelian,
            'kondisibarang_id' => $request->kondisibarang_id,
            'statusbarang_id' => $request->statusbarang_id,
        ]);

        $inventaris->update([
            'id' =>
                $request->subsubkelompokbarang_id .
                sprintf('%03s', $noRegister),
        ]);

        if ($inventaris) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventaris->id .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventaris->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.inventaris.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' . $request->id . ' gagal diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.inventaris.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data inventaris ' . $request->id . ' gagal diubah!'
                    );
            }
        }
    }
}
