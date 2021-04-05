<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisBarang;
use App\Models\PengajuanBarang;
use App\Models\InventarisDiperbaiki;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Dashboard';
        $data['app'] = 'Assek App';

        $data['totalInventarisBarang'] = InventarisBarang::count();
        $data['totalPengajuanBarang'] =
            PengajuanBarang::where('statuspengajuan_id', 1)->count() +
            InventarisDiperbaiki::where('statuspengajuan_id', 1)->count();
        $data['totalUser'] = User::where('id', '<>', 1)->count();
        $data['totalInventarisRusak'] = InventarisBarang::where(
            'kondisibarang_id',
            '<>',
            1
        )->count();

        return view('pages.welcome', compact('data'));
    }
}
