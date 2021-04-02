<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GolonganBarang;

class GolonganBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Golongan Barang';
        $data['app'] = 'Assek App';

        $data['golonganBarang'] = GolonganBarang::all();

        return view('pages.master.barang.golongan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:golonganbarang,nama',
        ]);

        $golonganBarang = GolonganBarang::create([
            'nama' => ucwords($request->nama),
        ]);

        if ($golonganBarang) {
            return redirect()
                ->route('admin.master.barang.golongan.index')
                ->with(
                    'success_message',
                    'Data ' . ucwords($request->nama) . ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.golongan.index')
                ->with(
                    'error_message',
                    'Data golongan barang gagal ditambahkan!'
                );
        }
    }

    public function destroy(Request $request)
    {
        $golonganBarang = GolonganBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($golonganBarang) {
            return redirect()
                ->route('admin.master.barang.golongan.index')
                ->with(
                    'success_message',
                    'Data Golongan Barang berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.golongan.index')
                ->with('error_message', 'Data Golongan Barang gagal dihapus!');
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Golongan Barang';
        $data['app'] = 'Assek App';

        $data['golonganBarang'] = GolonganBarang::find($id);
        return view('pages.master.barang.golongan.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $gedung = GolonganBarang::find($request->id)->update([
            'nama' => ucwords($request->nama),
        ]);

        if ($gedung) {
            return redirect()
                ->route('admin.master.barang.golongan.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.golongan.edit', [
                    'id' => $request->id,
                ])
                ->with(
                    'error_message',
                    'Data ' . $request->nama . ' gagal diubah!'
                );
        }
    }
}
