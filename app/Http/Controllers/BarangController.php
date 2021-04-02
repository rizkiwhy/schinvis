<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'Barang';
        $data['app'] = 'Assek App';

        return view('pages.master.barang.index', compact('data'));
    }
}
