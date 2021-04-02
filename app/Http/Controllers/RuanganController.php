<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ruangan;
use App\Models\Gedung;

class RuanganController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Ruangan';
        $data['app'] = 'Assek App';
        $data['ruangan'] = Ruangan::with('gedung')->get();
        $data['gedung'] = Gedung::get();

        return view('pages.master.lokasi.ruangan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:ruangan,nama',
            'gedung_id' => 'required',
            'panjang_ruangan' => 'required',
            'lebar_ruangan' => 'required',
        ]);

        if (
            empty($request->panjang_koridor_depan) ||
            empty($request->lebar_koridor_depan) ||
            empty($request->panjang_koridor_belakang) ||
            empty($request->lebar_koridor_belakang)
        ) {
            $koridorDepan = '0x0';
            $koridorBelakang = '0x0';
        } else {
            $koridorDepan =
                $request->panjang_koridor_depan .
                'x' .
                $request->lebar_koridor_depan;
            $koridorBelakang =
                $request->panjang_koridor_belakang .
                'x' .
                $request->lebar_koridor_belakang;
        }

        $ruangan = Ruangan::create([
            'nama' => ucwords($request->nama),
            'gedung_id' => $request->gedung_id,
            'luas' => $request->panjang_ruangan . 'x' . $request->lebar_ruangan,
            'koridor_depan' => $koridorDepan,
            'koridor_belakang' => $koridorBelakang,
        ]);

        if ($ruangan) {
            return redirect()
                ->route('admin.master.lokasi.ruangan.index')
                ->with(
                    'success_message',
                    'Data ' .
                        ucwords($request->nama) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.lokasi.ruangan.index')
                ->with('error_message', 'Data Ruangan gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Ruangan';
        $data['app'] = 'Assek App';

        $data['ruangan'] = Ruangan::find($id);
        $data['gedung'] = Gedung::all();
        return view('pages.master.lokasi.ruangan.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'gedung_id' => 'required',
            'panjang_ruangan' => 'required',
            'lebar_ruangan' => 'required',
        ]);

        if (
            empty($request->panjang_koridor_depan) ||
            empty($request->lebar_koridor_depan) ||
            empty($request->panjang_koridor_belakang) ||
            empty($request->lebar_koridor_belakang)
        ) {
            $koridorDepan = '0x0';
            $koridorBelakang = '0x0';
        } else {
            $koridorDepan =
                $request->panjang_koridor_depan .
                'x' .
                $request->lebar_koridor_depan;
            $koridorBelakang =
                $request->panjang_koridor_belakang .
                'x' .
                $request->lebar_koridor_belakang;
        }

        $ruangan = Ruangan::find($request->id)->update([
            'nama' => ucwords($request->nama),
            'gedung_id' => $request->gedung_id,
            'luas' => $request->panjang_ruangan . 'x' . $request->lebar_ruangan,
            'koridor_depan' => $koridorDepan,
            'koridor_belakang' => $koridorBelakang,
        ]);

        if ($ruangan) {
            return redirect()
                ->route('admin.master.lokasi.ruangan.index')
                ->with(
                    'success_message',
                    'Data ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.lokasi.ruangan.edit', [
                    'id' => $request->id,
                ])
                ->with('error_message', 'Data Ruangan gagal diubah!');
        }
    }
    public function destroy(Request $request)
    {
        $ruangan = Ruangan::where('id', $request->delete_id)->delete();

        if ($ruangan) {
            return redirect()
                ->route('admin.master.lokasi.ruangan.index')
                ->with('success_message', 'Data Ruangan berhasil dihapus!');
        } else {
            return redirect()
                ->route('admin.master.lokasi.ruangan.index')
                ->with('error_message', 'Data Ruangan gagal dihapus!');
        }
    }
}
