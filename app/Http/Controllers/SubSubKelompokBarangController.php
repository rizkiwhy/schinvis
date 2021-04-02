<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubSubKelompokBarang;
use App\Models\SubKelompokBarang;

class SubSubKelompokBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Sub Sub Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::with(
            'subKelompokBarang'
        )->get();
        $data['subKelompokBarang'] = SubKelompokBarang::all();

        return view(
            'pages.master.barang.subsubkelompok.index',
            compact('data')
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required|unique:subsubkelompokbarang,nama',
            'subkelompokbarang_id' => 'required',
        ]);

        $subSubKelompokBarang = SubSubKelompokBarang::create([
            'id' =>
                $request->subkelompokbarang_id .
                sprintf('%02s', $request->kode),
            'nama' => ucwords($request->nama),
            'subkelompokbarang_id' => $request->subkelompokbarang_id,
        ]);

        if ($subSubKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.index')
                ->with(
                    'success_message',
                    'Data ' . ucwords($request->nama) . ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.index')
                ->with(
                    'error_message',
                    'Data subsubkelompok barang gagal ditambahkan!'
                );
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Sub Sub Kelompok Barang';
        $data['app'] = 'Assek App';

        $data['subSubKelompokBarang'] = SubSubKelompokBarang::find($id);
        $data['subKelompokBarang'] = SubKelompokBarang::all();
        return view('pages.master.barang.subsubkelompok.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'subkelompokbarang_id' => 'required',
        ]);

        $subSubKelompokBarang = SubSubKelompokBarang::find($request->id);
        $subSubKelompokBarang->update([
            'nama' => ucwords($request->nama),
            'subkelompokbarang_id' => $request->subkelompokbarang_id,
        ]);

        $subSubKelompokBarang->update([
            'id' =>
                $request->subkelompokbarang_id .
                sprintf('%02s', $request->kode),
        ]);

        if ($subSubKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.edit', [
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
        $subSubKelompokBarang = SubSubKelompokBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($subSubKelompokBarang) {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.index')
                ->with(
                    'success_message',
                    'Data Sub Sub Kelompok Barang berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.subsubkelompok.index')
                ->with(
                    'error_message',
                    'Data Sub Sub Kelompok Barang gagal dihapus!'
                );
        }
    }

    public function detail(Request $request)
    {
        $data['subSubKelompokBarang'] = SubSubKelompokBarang::find(
            $request->id
        );
        return response()->json($data['subSubKelompokBarang']);
    }
}
