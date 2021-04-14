<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\InventarisDiperbaiki;
use App\Models\InventarisBarang;
use App\Models\InventarisDigunakan;
use App\Models\InventarisTersedia;
use App\Models\KondisiBarang;
use App\Models\User;
use App\Models\StatusPengajuan;

class PerbaikanController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Perbaikan Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDiperbaiki'] = InventarisDiperbaiki::with([
            'inventarisBarang.subsubkelompokbarang',
            'statuspengajuan',
            'user',
        ])->get();

        $data[
            'inventarisTidakDiperbaiki'
        ] = InventarisBarang::whereNotIn('statusbarang_id', [3])->get();

        $data['kondisiBarang'] = KondisiBarang::whereNotIn('id', [1])->get();

        $data['user'] = User::all();

        return view('pages.gudang.perbaikan.index', compact('data'));
    }

    public function indexPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Perbaikan Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDiperbaiki'] = InventarisDiperbaiki::with([
            'inventarisBarang.subsubkelompokbarang',
            'statuspengajuan',
            'user',
        ])
            ->where('user_id', Auth::user()->id)
            ->get();

        $data['inventarisTidakDiperbaiki'] = InventarisDigunakan::where(
            'user_id',
            Auth::user()->id
        )
            ->alatkerja()
            ->whereNull('selesaidigunakan')
            ->get();

        $data['kondisiBarang'] = KondisiBarang::whereNotIn('id', [1])->get();

        $data['user'] = User::all();

        return view('pages.transaksi.perbaikan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inventarisbarang_id' => 'required',
            'kondisibarang_id' => 'required',
            'masalah' => 'required',
        ]);

        $inventarisBarang = InventarisBarang::find(
            $request->inventarisbarang_id
        );

        //2104034001001
        $id = DB::table('inventarisdiperbaiki')
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        if ($inventarisBarang->statusbarang_id === 1) {
            // $inventarisTersedia = InventarisTersedia::where(
            //     'inventarisbarang_id',
            //     $request->inventarisbarang_id
            // )->delete();
            $inventarisDiperbaiki = InventarisDiperbaiki::create([
                'id' =>
                    substr(date('Ymd'), 2) .
                    4 .
                    sprintf('%03s', $request->user_id) .
                    sprintf('%03s', $id),
                'inventarisbarang_id' => $request->inventarisbarang_id,
                'masalah' => $request->masalah,
                'jenispengajuanbarang_id' => 4,
                'statuspengajuan_id' => 1,
                'user_id' => 1,
            ]);
        } else {
            $inventarisDigunakan = InventarisDigunakan::where(
                'inventarisbarang_id',
                $request->inventarisbarang_id
            )->first();
            $inventarisDiperbaiki = InventarisDiperbaiki::create([
                'id' =>
                    substr(date('Ymd'), 2) .
                    4 .
                    sprintf('%03s', $request->user_id) .
                    sprintf('%03s', $id),
                'inventarisbarang_id' => $request->inventarisbarang_id,
                'masalah' => $request->masalah,
                'jenispengajuanbarang_id' => 4,
                'statuspengajuan_id' => 1,
                'user_id' => $inventarisDigunakan->user_id,
            ]);
            // $inventarisDigunakan->delete();
        }

        $inventarisBarang->update([
            'kondisibarang_id' => $request->kondisibarang_id,
            'statusbarang_id' => 3,
        ]);

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan gagal ditambahkan!'
                    );
            }
        }
    }

    public function storePribadi(Request $request)
    {
        $validatedData = $request->validate([
            'inventarisbarang_id' => 'required',
            'kondisibarang_id' => 'required',
            'masalah' => 'required',
        ]);

        $inventarisBarang = InventarisBarang::find(
            $request->inventarisbarang_id
        );
        $inventarisDigunakan = InventarisDigunakan::where(
            'inventarisbarang_id',
            $request->inventarisbarang_id
        )->first();
        $id = DB::table('inventarisdiperbaiki')
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);
        $inventarisDiperbaiki = InventarisDiperbaiki::create([
            'id' =>
                substr(date('Ymd'), 2) .
                4 .
                sprintf('%03s', Auth::user()->id) .
                sprintf('%03s', $id),
            'inventarisbarang_id' => $request->inventarisbarang_id,
            'masalah' => $request->masalah,
            'jenispengajuanbarang_id' => 4,
            'statuspengajuan_id' => 1,
            'user_id' => $inventarisDigunakan->user_id,
        ]);
        // $inventarisDigunakan->delete();

        $inventarisBarang->update([
            'kondisibarang_id' => $request->kondisibarang_id,
            'statusbarang_id' => 3,
        ]);

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan gagal ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan gagal ditambahkan!'
                    );
            }
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Perbaikan';
        $data['app'] = 'Assek App';

        $data['inventarisDiperbaiki'] = InventarisDiperbaiki::find($id);
        $data['user'] = User::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view('pages.gudang.perbaikan.edit', compact('data'));
    }

    public function editPribadi($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Perbaikan';
        $data['app'] = 'Assek App';

        $data['inventarisDiperbaiki'] = InventarisDiperbaiki::find($id);
        $data['inventarisBarang'] = InventarisBarang::find(
            $data['inventarisDiperbaiki']->inventarisbarang_id
        );
        $data['kondisiBarang'] = KondisiBarang::whereNotIn('id', [1])->get();

        return view('pages.transaksi.perbaikan.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'inventarisbarang_id' => 'required',
            'masalah' => 'required',
            'user_id' => 'required',
        ]);

        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->id);
        $inventarisDiperbaiki->update([
            'inventarisbarang_id' => $request->inventarisbarang_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'user_id' => $request->user_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'masalah' => $request->masalah,
            'estimasiperbaikan' => $request->estimasiperbaikan,
            'mulaiperbaikan' => $request->mulaiperbaikan,
            'selesaiperbaikan' => $request->selesaiperbaikan,
            'solusi' => $request->solusi,
        ]);

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.edit', [
                        'id' => $request->id,
                    ])
                    ->with('error_message', 'Data perbaikan gagal diubah!');
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.edit', [
                        'id' => $request->id,
                    ])
                    ->with('error_message', 'Data perbaikan gagal diubah!');
            }
        }
    }

    public function updatePribadi(Request $request)
    {
        $validatedData = $request->validate([
            'inventarisbarang_id' => 'required',
            'kondisibarang_id' => 'required',
            'masalah' => 'required',
        ]);

        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->id);
        $inventarisDiperbaiki->update([
            'masalah' => $request->masalah,
        ]);

        $inventarisBarang = InventarisBarang::find(
            $request->inventarisbarang_id
        );
        $inventarisBarang->update([
            'kondisibarang_id' => $request->kondisibarang_id,
        ]);

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal diubah!');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal diubah!');
            } else {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal diubah!');
            }
        }
    }

    public function destroy(Request $request)
    {
        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->delete_id);

        // if ($inventarisDiperbaiki->user_id === 1) {
        // $inventarisBarang = InventarisBarang::find(
        //     $inventarisDiperbaiki->inventarisbarang_id
        // );
        $inventarisDigunakan = InventarisDigunakan::where(
            'inventarisbarang_id',
            $inventarisDiperbaiki->inventarisbarang_id
        )
            ->whereNull('selesaidigunakan')
            ->count();
        // dd($inventarisDigunakan);
        if ($inventarisDigunakan > 0) {
            $statusBarangId = 2;
        } else {
            $statusBarangId = 1;
        }
        $inventarisDiperbaiki->inventarisBarang->update([
            'kondisibarang_id' => 1,
            'statusbarang_id' => $statusBarangId,
        ]);
        // } else {
        //     $inventarisBarang = InventarisBarang::find(
        //         $inventarisDiperbaiki->inventarisbarang_id
        //     );
        //     $inventarisBarang->update([
        //         'kondisibarang_id' => 1,
        //         'statusbarang_id' => 2,
        //     ]);
        // $inventarisDigunakan = InventarisDigunakan::where(
        //     'user_id',
        //     $inventarisDiperbaiki->user_id
        // )->first();
        // $inventarisDigunakan = InventarisDigunakan::create([
        //     'inventarisbarang_id' =>
        //         $inventarisDiperbaiki->inventarisbarang_id,
        //     'ruangan_id' => 9, // Harusnya ruangan_id gudang
        //     'user_id' => $inventarisDiperbaiki->user_id,
        // ]);
        // }

        $inventarisDiperbaiki->delete();

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with('error_message', 'Data perbaikan gagal dihapus!');
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with('error_message', 'Data perbaikan gagal dihapus!');
            }
        }
    }

    public function destroyPribadi(Request $request)
    {
        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->delete_id);
        InventarisDigunakan::where(
            'inventarisbarang_id',
            $inventarisDiperbaiki->inventarisbarang_id
        )
            ->whereNull('selesaidigunakan')
            ->count() > 0
            ? ($statusBarangId = 2)
            : ($statusBarangId = 1);
        $inventarisDiperbaiki->inventarisBarang->update([
            'kondisibarang_id' => 1,
            'statusbarang_id' => $statusBarangId,
        ]);

        $inventarisDiperbaiki->delete();

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data perbaikan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal dihapus!');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal dihapus!');
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.transaksi.perbaikan.indexpribadi')
                    ->with('error_message', 'Data perbaikan gagal dihapus!');
            }
        }
    }

    public function start(Request $request)
    {
        $request->validate([
            'estimasiperbaikan' => 'required',
        ]);
        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->start_id);
        $inventarisDiperbaiki->update([
            'mulaiperbaikan' => date('Ymd'),
            'statuspengajuan_id' => 2,
            'estimasiperbaikan' => $request->estimasiperbaikan,
        ]);

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' sedang diperbaiki!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' sedang diperbaiki!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' gagal untuk dimulai perbaikan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' gagal untuk dimulai perbaikan!'
                    );
            }
        }
    }

    public function end(Request $request)
    {
        $request->validate([
            'solusi' => 'required',
        ]);
        $inventarisDiperbaiki = InventarisDiperbaiki::find($request->end_id);
        $inventarisDiperbaiki->update([
            'selesaiperbaikan' => date('Ymd'),
            'statuspengajuan_id' => 3,
            'solusi' => $request->solusi,
        ]);

        if ($inventarisDiperbaiki->user_id === 1) {
            $inventarisBarang = InventarisBarang::find(
                $inventarisDiperbaiki->inventarisbarang_id
            );
            $inventarisBarang->update([
                'kondisibarang_id' => 1,
                'statusbarang_id' => 1,
            ]);
        } else {
            $inventarisBarang = InventarisBarang::find(
                $inventarisDiperbaiki->inventarisbarang_id
            );
            $inventarisBarang->update([
                'kondisibarang_id' => 1,
                'statusbarang_id' => 2,
            ]);
            // $inventarisDigunakan = InventarisDigunakan::where(
            //     'user_id',
            //     $inventarisDiperbaiki->user_id
            // )->first();
            // $inventarisDigunakan = InventarisDigunakan::create([
            //     'inventarisbarang_id' => $inventarisDiperbaiki->id,
            //     'ruangan_id' => $inventarisDigunakan->ruangan_id,
            //     'user_id' => $inventarisDiperbaiki->user_id,
            // ]);
        }

        if ($inventarisDiperbaiki) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' selesai diperbaiki!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'success_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' selesai diperbaiki!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' gagal untuk selesai diperbaiki!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDiperbaiki->id .
                            ' gagal untuk selesai diperbaiki!'
                    );
            }
        }
    }
}
