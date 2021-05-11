<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InventarisDigunakan;
use App\Models\InventarisBarang;
use App\Models\InventarisTersedia;
use App\Models\PengajuanBarang;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Peminjaman Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->pinjam()
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanpinjam()
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

        return view('pages.gudang.peminjaman.index', compact('data'));
    }

    public function indexPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Peminjaman Barang';
        $data['app'] = 'Assek App';

        $data['inventarisDigunakan'] = InventarisDigunakan::with([
            'inventarisBarang.subsubkelompokbarang',
            'ruangan',
            'user',
        ])
            ->where('user_id', Auth::user()->id)
            ->pinjam()
            ->get();

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanpinjam()
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

        return view('pages.transaksi.peminjaman.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
            'ruangan_id' => 'required',
            'user_id' => 'required',
        ]);

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
                    ->route('admin.gudang.peminjaman.index')
                    ->with(
                        'error_message',
                        'Jumlah inventaris tersedia tidak mencukupi jumlah permintaan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.index')
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
                    ->where('jenispenggunaanbarang_id', 2)
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

                $inventarisBarang = InventarisBarang::where(
                    'statusbarang_id',
                    1
                )->first();
                $inventarisDigunakan = InventarisDigunakan::create([
                    'id' =>
                        substr(date('Ymd'), 2) .
                        2 .
                        sprintf('%03s', $request->user_id) .
                        sprintf('%03s', $noPengajuan) .
                        sprintf('%03s', $id),
                    'mulaidigunakan' => date('Ymd'),
                    'nopengajuan' => $request->pengajuanbarang_id,
                    'inventarisbarang_id' => $inventarisBarang->id,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                    'jenispenggunaanbarang_id' => 2,
                ]);
                $inventarisBarang->update([
                    'statusbarang_id' => 2,
                ]);
            }
            if (!empty($request->pengajuanbarang_id)) {
                $pengajuanBarang = PengajuanBarang::find(
                    $request->pengajuanbarang_id
                )->update([
                    'statuspengajuan_id' => 2,
                ]);
            }
        }

        $jumlahAkhir = InventarisDigunakan::count();

        if ($jumlahAkhir === $jumlahAwal + $request->jumlahbarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil dipinjamkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris berhasil dipinjamkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal dipinjamkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.index')
                    ->with(
                        'error_message',
                        'Data inventaris gagal dipinjamkan!'
                    );
            }
        }
    }

    public function end(Request $request)
    {
        $inventarisDigunakan = InventarisDigunakan::find($request->end_id);
        $inventarisDigunakan->update([
            'selesaidigunakan' => date('Ymd'),
        ]);

        $inventarisBarang = InventarisBarang::find(
            $inventarisDigunakan->inventarisbarang_id
        );
        $inventarisBarang->update([
            'statusbarang_id' => 1,
        ]);

        if (!empty($inventarisDigunakan->nopengajuan)) {
            $jumlahBarangSelesaiDigunakan = InventarisDigunakan::where(
                'nopengajuan',
                $inventarisDigunakan->nopengajuan
            )
                ->whereNotNull('selesaidigunakan')
                ->count();

            $pengajuanPeminjaman = PengajuanBarang::find(
                $inventarisDigunakan->nopengajuan
            );

            if (
                $jumlahBarangSelesaiDigunakan ===
                $pengajuanPeminjaman->jumlahbarang
            ) {
                $pengajuanPeminjaman->update([
                    'statuspengajuan_id' => 3,
                ]);
            }
        }

        if ($inventarisDigunakan) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dikembalikan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dikembalikan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            }
        }
    }

    public function destroy(Request $request)
    {
        $inventarisDigunakan = InventarisDigunakan::find($request->delete_id);
        // $inventarisDigunakan->update([
        //     'selesaidigunakan' => date('Ymd'),
        // ]);

        $inventarisBarang = $inventarisDigunakan->inventarisBarang;
        // dd($inventarisBarang);
        // InventarisBarang::find(
        //     $inventarisDigunakan->inventarisbarang_id
        // );
        $inventarisBarang->update([
            'statusbarang_id' => 1,
        ]);

        if (!empty($inventarisDigunakan->nopengajuan)) {
            $jumlahBarangSelesaiDigunakan = InventarisDigunakan::where(
                'nopengajuan',
                $inventarisDigunakan->nopengajuan
            )
                ->whereNotNull('selesaidigunakan')
                ->count();

            $pengajuanPeminjaman = PengajuanBarang::find(
                $inventarisDigunakan->nopengajuan
            );

            if (
                $jumlahBarangSelesaiDigunakan ===
                $pengajuanPeminjaman->jumlahbarang
            ) {
                $pengajuanPeminjaman->update([
                    'statuspengajuan_id' => 3,
                ]);
            }
        }

        $inventarisDigunakan->delete();
        if ($inventarisDigunakan) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.index')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.perbaikan.index')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            }
        }
    }

    public function endPribadi(Request $request)
    {
        $inventarisDigunakan = InventarisDigunakan::find($request->end_id);
        $inventarisDigunakan->update([
            'selesaidigunakan' => date('Ymd'),
        ]);

        $inventarisBarang = InventarisBarang::find(
            $inventarisDigunakan->inventarisbarang_id
        );
        $inventarisBarang->update([
            'statusbarang_id' => 1,
        ]);

        if (!empty($inventarisDigunakan->nopengajuan)) {
            $jumlahBarangSelesaiDigunakan = InventarisDigunakan::where(
                'nopengajuan',
                $inventarisDigunakan->nopengajuan
            )
                ->whereNotNull('selesaidigunakan')
                ->count();

            $pengajuanPeminjaman = PengajuanBarang::find(
                $inventarisDigunakan->nopengajuan
            );

            if (
                $jumlahBarangSelesaiDigunakan ===
                $pengajuanPeminjaman->jumlahbarang
            ) {
                $pengajuanPeminjaman->update([
                    'statuspengajuan_id' => 3,
                ]);
            }
        }

        if ($inventarisDigunakan) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.peminjaman.indexpribadi')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dikembalikan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.transaksi.peminjaman.indexpribadi')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dikembalikan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.transaksi.peminjaman.indexpribadi')
                    ->with(
                        'success_message',
                        'Data inventaris ' .
                            $inventarisDigunakan->id .
                            ' berhasil dikembalikan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.transaksi.peminjaman.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.gudang.perbaikan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('management.gudang.perbaikan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data perbaikan ' .
                            $inventarisDigunakan->id .
                            ' gagal untuk selesai diperbaikan!'
                    );
            }
        }
    }
}
