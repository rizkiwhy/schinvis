<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Dashboard';
        $data['app'] = 'Assek App';

        return view('pages.welcome', compact('data'));
    }
}
