<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubKelompokBarang;
use App\Models\KelompokBarang;

class SubKelompokBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Sub Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['subKelompokBarang'] = SubKelompokBarang::with('kelompokBarang')->get();
        $data['kelompokBarang'] = KelompokBarang::all();

        return view('pages.master.barang.subkelompok.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required|unique:subkelompokbarang,nama',
            'kelompokbarang_id' => 'required',
        ]);

        $subKelompokBarang = SubKelompokBarang::create([
            'id' => $request->kelompokbarang_id . sprintf('%02s', $request->kode),
            'nama' => ucwords($request->nama),
            'kelompokbarang_id' => $request->kelompokbarang_id,
        ]);

        if ($subKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subkelompok.index')
                ->with(
                    'success_message',
                    'Data ' . ucwords($request->nama) . ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subkelompok.index')
                ->with(
                    'error_message',
                    'Data subkelompok barang gagal ditambahkan!'
                );
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Sub Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['subKelompokBarang'] = SubKelompokBarang::find($id);
        $data['kelompokBarang'] = KelompokBarang::all();
        return view('pages.master.barang.subkelompok.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kelompokbarang_id' => 'required',
        ]);

        $subKelompokBarang = SubKelompokBarang::find($request->id);
        $subKelompokBarang->update([
            'nama' => ucwords($request->nama),
            'kelompokbarang_id' => $request->kelompokbarang_id,
        ]);

        $subKelompokBarang->update([
            'id' =>
                $request->kelompokbarang_id . sprintf('%02s', $request->kode),
        ]);

        if ($subKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subkelompok.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subkelompok.edit', [
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
        $subKelompokBarang = SubKelompokBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($subKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subkelompok.index')
                ->with(
                    'success_message',
                    'Data Sub Kelompok Barang berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subkelompok.index')
                ->with('error_message', 'Data Sub Kelompok Barang gagal dihapus!');
        }
    }
}
