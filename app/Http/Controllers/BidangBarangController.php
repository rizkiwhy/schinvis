<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BidangBarang;
use App\Models\GolonganBarang;

class BidangBarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Bidang Barang';
        $data['app'] = 'Assek App';

        $data['bidangBarang'] = BidangBarang::with('golonganbarang')->get();
        $data['golonganBarang'] = GolonganBarang::all();

        return view('pages.master.barang.bidang.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:bidangbarang,nama',
            'golonganbarang_id' => 'required',
        ]);
        $lastBidangBarangId = BidangBarang::count();
        $bidangBarang = BidangBarang::create([
            'id' =>
                $request->golonganbarang_id .
                sprintf('%02s', ++$lastBidangBarangId),
            'nama' => ucwords($request->nama),
            'golonganbarang_id' => $request->golonganbarang_id,
        ]);

        if ($bidangBarang) {
            return redirect()
                ->route('admin.master.barang.bidang.index')
                ->with(
                    'success_message',
                    'Data ' . ucwords($request->nama) . ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.bidang.index')
                ->with(
                    'error_message',
                    'Data bidang barang gagal ditambahkan!'
                );
        }
    }

    public function destroy(Request $request)
    {
        $bidangBarang = BidangBarang::where(
            'id',
            $request->delete_id
        )->delete();

        if ($bidangBarang) {
            return redirect()
                ->route('admin.master.barang.bidang.index')
                ->with(
                    'success_message',
                    'Data Bidang Barang berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.bidang.index')
                ->with('error_message', 'Data Bidang Barang gagal dihapus!');
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Golongan Barang';
        $data['app'] = 'Assek App';

        $data['bidangBarang'] = BidangBarang::find($id);
        $data['golonganBarang'] = GolonganBarang::all();
        return view('pages.master.barang.bidang.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'golonganbarang_id' => 'required',
        ]);

        $bidangBarang = BidangBarang::find($request->id);
        $tempBidangBarangId = $bidangBarang->id;
        $bidangBarang->update([
            'nama' => ucwords($request->nama),
            'golonganbarang_id' => $request->golonganbarang_id,
        ]);

        $bidangBarang->update([
            'id' =>
                $request->golonganbarang_id .
                sprintf('%02s', substr($tempBidangBarangId, -2)),
        ]);

        if ($bidangBarang) {
            return redirect()
                ->route('admin.master.barang.bidang.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.barang.bidang.edit', [
                    'id' => $request->id,
                ])
                ->with(
                    'error_message',
                    'Data ' . $request->nama . ' gagal diubah!'
                );
        }
    }
}
