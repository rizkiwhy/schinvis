<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Title';
        $data['app'] = 'Assek App';
        $data['title'] = Title::all();

        return view('pages.master.title.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:title,nama',
            'aktif' => 'required',
        ]);

        // dd($request->all());
        $title = Title::create([
            'nama' => ucwords($request->nama),
            'aktif' => $request->aktif,
        ]);

        if ($title) {
            return redirect()
                ->route('admin.master.title.index')
                ->with(
                    'success_message',
                    'Data title ' .
                        ucwords($request->nama) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.master.title.index')
                ->with('error_message', 'Data  title gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'Title';
        $data['app'] = 'Assek App';

        $data['title'] = Title::where('id', $id)->get();
        return view('pages.master.title.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'aktif' => 'required',
        ]);

        $title = Title::where('id', $request->id)->update([
            'nama' => ucwords($request->nama),
            'aktif' => $request->aktif,
        ]);

        if ($title) {
            return redirect()
                ->route('admin.master.title.index')
                ->with(
                    'success_message',
                    'Data Title ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.master.title.edit', ['id' => $request->id])
                ->with('error_message', 'Data Title gagal diubah!');
        }
    }

    public function destroy(Request $request)
    {
        $title = Title::where('id', $request->delete_id)->delete();

        if ($title) {
            return redirect()
                ->route('admin.master.title.index')
                ->with('success_message', 'Data Title berhasil dihapus!');
        } else {
            return redirect()
                ->route('admin.master.title.index')
                ->with('error_message', 'Data Title gagal dihapus!');
        }
    }
}
