<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Gedung';
        $data['app'] = 'Assek App';

        $data['gedung'] = Gedung::all();

        return view('pages.master.lokasi.gedung.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:gedung,nama',
            'kode' => 'required|unique:gedung,kode',
            'kelompok' => 'required',
        ]);

        $gedung = Gedung::create([
            'nama' => ucwords($request->nama),
            'kode' => ucwords($request->kode),
            'kelompok' => $request->kelompok,
        ]);

        if ($gedung) {
            return redirect()
                ->route('admin.master.lokasi.gedung.index')
                ->with(
                    'success_message',
                    'Data Gedung ' .
                        ucwords($request->nama) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.lokasi.gedung.index')
                ->with('error_message', 'Data Gedung gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Gedung';
        $data['app'] = 'Assek App';

        $data['gedung'] = Gedung::find($id);
        return view('pages.master.lokasi.gedung.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        $gedung = Gedung::find($request->id)->update([
            'nama' => ucwords($request->nama),
            'kode' => ucwords($request->kode),
        ]);

        if ($gedung) {
            return redirect()
                ->route('admin.master.lokasi.gedung.index')
                ->with(
                    'success_message',
                    'Data Gedung ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.lokasi.gedung.edit', [
                    'id' => $request->id,
                ])
                ->with('error_message', 'Data Gedung gagal diubah!');
        }
    }

    public function destroy(Request $request)
    {
        $gedung = Gedung::where('id', $request->delete_id)->delete();

        if ($gedung) {
            return redirect()
                ->route('admin.master.lokasi.gedung.index')
                ->with('success_message', 'Data Gedung berhasil dihapus!');
        } else {
            return redirect()
                ->route('admin.master.lokasi.gedung.index')
                ->with('error_message', 'Data Gedung gagal dihapus!');
        }
    }
}
