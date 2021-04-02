<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KelompokBarang;
use App\Models\BidangBarang;

class KelompokBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['kelompokBarang'] = KelompokBarang::with('bidangBarang')->get();
        $data['bidangBarang'] = BidangBarang::all();

        return view('pages.master.barang.kelompok.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required|unique:kelompokbarang,nama',
            'bidangbarang_id' => 'required',
        ]);

        $kelompokBarang = KelompokBarang::create([
            'id' => $request->bidangbarang_id . sprintf('%02s', $request->kode),
            'nama' => ucwords($request->nama),
            'bidangbarang_id' => $request->bidangbarang_id,
        ]);

        if ($kelompokBarang) {
            return redirect()
                ->route('admin.master.barang.kelompok.index')
                ->with(
                    'success_message',
                    'Data ' . ucwords($request->nama) . ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.kelompok.index')
                ->with(
                    'error_message',
                    'Data kelompok barang gagal ditambahkan!'
                );
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['kelompokBarang'] = KelompokBarang::find($id);
        $data['bidangBarang'] = BidangBarang::all();
        return view('pages.master.barang.kelompok.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'bidangbarang_id' => 'required',
        ]);

        $kelompokBarang = KelompokBarang::find($request->id);
        $kelompokBarang->update([
            'nama' => ucwords($request->nama),
            'bidangbarang_id' => $request->bidangbarang_id,
        ]);

        $kelompokBarang->update([
            'id' =>
                $request->bidangbarang_id . sprintf('%02s', $request->kode),
        ]);

        if ($kelompokBarang) {
            return redirect()
                ->route('admin.master.barang.kelompok.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.kelompok.edit', [
                    'id' => $request->id,
                ])
                ->with(
                    'error_message',
                    'Data ' . $request->nama . ' gagal diubah!'
                );
        }
    }

    public function destroy(Request $request)
    {
        $kelompokBarang = KelompokBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($kelompokBarang) {
            return redirect()
                ->route('admin.master.barang.kelompok.index')
                ->with(
                    'success_message',
                    'Data Kelompok Barang berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.kelompok.index')
                ->with('error_message', 'Data Kelompok Barang gagal dihapus!');
        }
    }
}
