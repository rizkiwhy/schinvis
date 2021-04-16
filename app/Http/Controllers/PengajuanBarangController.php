<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PengajuanBarang;
use App\Models\JenisPengajuanBarang;
use App\Models\SubSubKelompokBarang;
use App\Models\User;
use App\Models\StatusPengajuan;
use App\Models\InventarisDigunakan;

class PengajuanBarangController extends Controller
{
    public function indexAntrianPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::with([
            'user',
            'jenispengajuanbarang',
            'subsubkelompokbarang',
            'statuspengajuan',
        ])
            ->pribadi()
            ->dalamantrian()
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.pengajuan.index', compact('data'));
    }
    public function indexAntrian()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::with([
            'user',
            'jenispengajuanbarang',
            'subsubkelompokbarang',
            'statuspengajuan',
        ])
            ->dalamantrian()
            ->get();

        $data['jenisPengajuanBarang'] = JenisPengajuanBarang::whereNotIn('id', [
            4,
        ])->get();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.gudang.pengajuan.index', compact('data'));
    }

    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbarang()
            ->with([
                'user',
                'jenispengajuanbarang',
                'subsubkelompokbarang',
                'statuspengajuan',
            ])
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.gudang.distribusi.pengajuan.index', compact('data'));
    }

    public function indexPermintaan()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan Permintaan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbaranghabispakai()
            ->with([
                'user',
                'jenispengajuanbarang',
                'subsubkelompokbarang',
                'statuspengajuan',
            ])
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.gudang.permintaan.pengajuan.index', compact('data'));
    }

    public function indexPermintaanPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan Permintaan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanbaranghabispakai()
            ->with([
                'user',
                'jenispengajuanbarang',
                'subsubkelompokbarang',
                'statuspengajuan',
            ])
            ->pribadi()
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view(
            'pages.transaksi.permintaan.pengajuan.index',
            compact('data')
        );
    }

    public function indexPeminjaman()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan Peminjaman';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanpinjam()
            ->with([
                'user',
                'jenispengajuanbarang',
                'subsubkelompokbarang',
                'statuspengajuan',
            ])
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.gudang.peminjaman.pengajuan.index', compact('data'));
    }

    public function indexPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::with([
            'user',
            'jenispengajuanbarang',
            'subsubkelompokbarang',
        ])
            ->pengajuanBarang()
            ->pribadi()
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view('pages.alat-kerja.pengajuan.index', compact('data'));
    }

    public function indexPeminjamanPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Pengajuan Peminjaman';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::pengajuanpinjam()
            ->pribadi()
            ->with([
                'user',
                'jenispengajuanbarang',
                'subsubkelompokbarang',
                'statuspengajuan',
            ])
            ->get();

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['user'] = User::all();

        return view(
            'pages.transaksi.peminjaman.pengajuan.index',
            compact('data')
        );
    }

    public function storePeminjaman(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            'user_id' => 'required',
            'estimasipenggunaan' => 'required',
            'subsubkelompokbarang_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 2)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                2 .
                sprintf('%03s', $request->user_id) .
                sprintf('%03s', $id),
            'user_id' => $request->user_id,
            'estimasipenggunaan' => $request->estimasipenggunaan,
            'jenispengajuanbarang_id' => 2,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function storePeminjamanPribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            // 'user_id' => 'required',
            'estimasipenggunaan' => 'required',
            'subsubkelompokbarang_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 2)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                2 .
                sprintf('%03s', Auth::user()->id) .
                sprintf('%03s', $id),
            'user_id' => Auth::user()->id,
            'estimasipenggunaan' => $request->estimasipenggunaan,
            'jenispengajuanbarang_id' => 2,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
            'keterangan' => $request->keterangan,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'user_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 1)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        // dd($request->all());

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                1 .
                sprintf('%03s', $request->user_id) .
                sprintf('%03s', $id),
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => 1,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function storePermintaan(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'user_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 3)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        // dd($request->all());

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                3 .
                sprintf('%03s', $request->user_id) .
                sprintf('%03s', $id),
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => 3,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.pengajuan.indexpermintaan')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.pengajuan.indexpermintaan')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function storePermintaanPribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            'subsubkelompokbarang_id' => 'required',
            // 'user_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 3)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        // dd($request->all());

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                3 .
                sprintf('%03s', $request->user_id) .
                sprintf('%03s', $id),
            'user_id' => Auth::user()->id,
            'jenispengajuanbarang_id' => 3,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function storePribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jumlahbarang' => 'required',
            'subsubkelompokbarang_id' => 'required',
        ]);

        $id = DB::table('pengajuanbarang')
            ->where('jenispengajuanbarang_id', 1)
            ->whereDate('created_at', date('Y-m-d'))
            // ->max(DB::raw('substring(id, -3, 3)')); // mysql
            ->max(DB::raw('substring(id::text, 11)')); // pgsql

        if ($id === null) {
            $id = 1;
        } else {
            $id = ++$id;
        }

        $id = substr($id, -3);

        $pengajuanBarang = PengajuanBarang::create([
            'id' =>
                substr(date('Ymd'), 2) .
                1 .
                sprintf('%03s', Auth::user()->id) .
                sprintf('%03s', $id),
            'user_id' => Auth::user()->id,
            'jenispengajuanbarang_id' => 1,
            'jumlahbarang' => $request->jumlahbarang,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => 1,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil ditambahkan!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('management.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'error_message',
                        'Data pengajuan gagal ditambahkan!'
                    );
            }
        }
    }

    public function show(Request $request)
    {
        $data['pengajuanBarang'] = PengajuanBarang::find($request->id);
        return response()->json($data['pengajuanBarang']);
    }

    public function showPeminjaman(Request $request)
    {
        $data['pengajuanBarang'] = PengajuanBarang::find($request->id);
        return response()->json($data['pengajuanBarang']);
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        $data['user'] = user::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view('pages.gudang.distribusi.pengajuan.edit', compact('data'));
    }

    public function editPermintaan($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan Pemintaan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        $data['user'] = user::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view('pages.gudang.permintaan.pengajuan.edit', compact('data'));
    }

    public function editPermintaanPribadi($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan Pemintaan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        $data['user'] = user::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view(
            'pages.transaksi.permintaan.pengajuan.edit',
            compact('data')
        );
    }

    public function editPeminjaman($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan Peminjaman';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        $data['user'] = user::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view('pages.gudang.peminjaman.pengajuan.edit', compact('data'));
    }

    public function editPeminjamanPribadi($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan Peminjaman';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        // $data['user'] = user::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        // $data['statusPengajuan'] = StatusPengajuan::all();

        return view(
            'pages.transaksi.peminjaman.pengajuan.edit',
            compact('data')
        );
    }

    public function editPribadi($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Pengajuan';
        $data['app'] = 'Assek App';

        $data['pengajuanBarang'] = PengajuanBarang::find($id);
        $data['user'] = user::all();
        $data['jenisPengajuanBarang'] = JenisPengajuanBarang::all();
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::all();
        $data['statusPengajuan'] = StatusPengajuan::all();

        return view('pages.alat-kerja.pengajuan.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
        ]);
        $pengajuanBarang->update([
            'id' => substr_replace(
                $pengajuanBarang->id,
                sprintf('%03s', $request->user_id) .
                    substr($pengajuanBarang->id, -3),
                7
            ),
            // 'id' => substr_replace(
            //     $inventarisDigunakan->id,
            //     sprintf('%03s', $request->user_id) .
            //         substr($inventarisDigunakan->id, -3),
            //     7
            // ),
            // substr(date('Ymd'), 2) .
            //     1 .
            //     sprintf('%03s', Auth::user()->id) .
            //     sprintf('%03s', $id),
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function updatePermintaan(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
        ]);
        $pengajuanBarang->update([
            'id' => substr_replace(
                $pengajuanBarang->id,
                sprintf('%03s', $request->user_id) .
                    substr($pengajuanBarang->id, -3),
                7
            ),
            // 'id' => substr_replace(
            //     $inventarisDigunakan->id,
            //     sprintf('%03s', $request->user_id) .
            //         substr($inventarisDigunakan->id, -3),
            //     7
            // ),
            // substr(date('Ymd'), 2) .
            //     1 .
            //     sprintf('%03s', Auth::user()->id) .
            //     sprintf('%03s', $id),
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.pengajuan.indexpermintaan')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.gudang.permintaan.pengajuan.editpermintaan',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.editpermintaan',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function updatePermintaanPribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
        ]);
        $pengajuanBarang->update([
            'id' => substr_replace(
                $pengajuanBarang->id,
                sprintf('%03s', $request->user_id) .
                    substr($pengajuanBarang->id, -3),
                7
            ),
            // 'id' => substr_replace(
            //     $inventarisDigunakan->id,
            //     sprintf('%03s', $request->user_id) .
            //         substr($inventarisDigunakan->id, -3),
            //     7
            // ),
            // substr(date('Ymd'), 2) .
            //     1 .
            //     sprintf('%03s', Auth::user()->id) .
            //     sprintf('%03s', $id),
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.editpermintaan',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.editpermintaan',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.permintaan.pengajuan.editpermintaan',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function updatePeminjaman(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
            'estimasipenggunaan' => $request->estimasipenggunaan,
        ]);
        $pengajuanBarang->update([
            'id' => substr_replace(
                $pengajuanBarang->id,
                sprintf('%03s', $request->user_id) .
                    substr($pengajuanBarang->id, -3),
                7
            ),
            // 'id' => substr_replace(
            //     $inventarisDigunakan->id,
            //     sprintf('%03s', $request->user_id) .
            //         substr($inventarisDigunakan->id, -3),
            //     7
            // ),
            // substr(date('Ymd'), 2) .
            //     1 .
            //     sprintf('%03s', Auth::user()->id) .
            //     sprintf('%03s', $id),
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function updatePeminjamanPribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        // dd($request->all());

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            // 'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
            'estimasipenggunaan' => $request->estimasipenggunaan,
        ]);
        $pengajuanBarang->update([
            'id' => substr_replace(
                $pengajuanBarang->id,
                sprintf('%03s', $request->user_id) .
                    substr($pengajuanBarang->id, -3),
                7
            ),
            // 'id' => substr_replace(
            //     $inventarisDigunakan->id,
            //     sprintf('%03s', $request->user_id) .
            //         substr($inventarisDigunakan->id, -3),
            //     7
            // ),
            // substr(date('Ymd'), 2) .
            //     1 .
            //     sprintf('%03s', Auth::user()->id) .
            //     sprintf('%03s', $id),
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.editpeminjamanpribadi',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.editpeminjamanpribadi',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.editpeminjamanpribadi',
                        [
                            'id' => $request->id,
                        ]
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function updatePribadi(Request $request)
    {
        $validatedData = $request->validate([
            'jenispengajuanbarang_id' => 'required',
            'subsubkelompokbarang_id' => 'required',
            'jumlahbarang' => 'required',
        ]);

        $pengajuanBarang = PengajuanBarang::find($request->id);
        $pengajuanBarang->update([
            'user_id' => $request->user_id,
            'jenispengajuanbarang_id' => $request->jenispengajuanbarang_id,
            'subsubkelompokbarang_id' => $request->subsubkelompokbarang_id,
            'statuspengajuan_id' => $request->statuspengajuan_id,
            'jumlahbarang' => $request->jumlahbarang,
            'keterangan' => $request->keterangan,
        ]);

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.editpribadi', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.editpribadi', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.edit', [
                        'id' => $request->id,
                    ])
                    ->with(
                        'error_message',
                        'Data pengajuan ' .
                            $pengajuanBarang->id .
                            ' gagal diubah!'
                    );
            }
        }
    }

    public function destroy(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.distribusi.pengajuan.index')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } else {
                return redirect()
                    ->route('management.gudang.distribusi.pengajuan.index')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            }
        }
    }

    public function destroyPermintaan(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.pengajuan.indexpermintaan')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.permintaan.pengajuan.indexpermintaan')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } else {
                return redirect()
                    ->route(
                        'management.gudang.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            }
        }
    }

    public function destroyPermintaanPribadi(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.permintaan.pengajuan.indexpermintaan'
                    )
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            }
        }
    }

    public function destroyPeminjaman(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan peminjaman berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'success_message',
                        'Data pengajuan peminjaman berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan peminjaman gagal dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.gudang.peminjaman.pengajuan.index')
                    ->with(
                        'error_message',
                        'Data pengajuan peminjaman gagal dihapus!'
                    );
            }
        }
    }

    public function destroyPeminjamanPribadi(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan peminjaman berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan peminjaman berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'success_message',
                        'Data pengajuan peminjaman berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route(
                        'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan peminjaman gagal dihapus!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan peminjaman gagal dihapus!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route(
                        'management.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    )
                    ->with(
                        'error_message',
                        'Data pengajuan peminjaman gagal dihapus!'
                    );
            }
        }
    }

    public function destroyPribadi(Request $request)
    {
        $pengajuanBarang = PengajuanBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($pengajuanBarang) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            } else {
                return redirect()
                    ->route('management.alat-kerja.pengajuan.indexpribadi')
                    ->with(
                        'success_message',
                        'Data pengajuan berhasil dihapus!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.alat-kerja.pengajuan.indexpribadi')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.alat-kerja.pengajuan.indexpribadi')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            } else {
                return redirect()
                    ->route('management.alat-kerja.pengajuan.indexpribadi')
                    ->with('error_message', 'Data pengajuan gagal dihapus!');
            }
        }
    }
}
