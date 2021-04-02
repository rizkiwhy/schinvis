<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        // $data['layout'] = 'layouts.master';
        $data['page'] = 'Login';
        $data['app'] = 'Assek App';

        return view('pages.auth.login', compact('data'));
    }

    public function actionLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        $user = User::where('email', $request->email)->first();

        // email tidak terdaftar
        if ($user === null) {
            return redirect()
                ->route('login.view')
                ->with(
                    'error_message',
                    'Email anda tidak terdaftar, Silahkan hubungi administrator!'
                );
        } else {
            // akun tidak aktif
            if ($user->aktif === 0) {
                return redirect()
                    ->route('login.view')
                    ->with(
                        'error_message',
                        'Akun anda tidak aktif, Silahkan hubungi administrator!'
                    );
            } else {
                // cek otentikasi
                if (
                    Auth::attempt([
                        'email' => $request->email,
                        'password' => $request->password,
                    ])
                ) {
                    if (Auth::user()->role_id == 1) {
                        // administrator berhasil login
                        return redirect()
                            ->route('admin.dashboard')
                            ->with(
                                'success_message',
                                'Selamat Datang ' . Auth::user()->nama
                            );
                    } elseif (Auth::user()->role_id == 2) {
                        // user berhasil login
                        return redirect()
                            ->route('user.dashboard')
                            ->with(
                                'success_message',
                                'Selamat Datang ' . Auth::user()->nama
                            );
                    } elseif (Auth::user()->role_id == 3) {
                        // management berhasil login
                        return redirect()
                            ->route('management.dashboard')
                            ->with(
                                'success_message',
                                'Selamat Datang ' . Auth::user()->nama
                            );
                    }
                }
                // password salah
                return redirect()
                    ->route('login.view')
                    ->with('error_message', 'Email atau Password salah!');
            }
        }
    }

    public function register()
    {
        // $data['layout'] = 'layouts.master';
        $data['page'] = 'Register';
        $data['app'] = 'Assek App';

        return view('pages.auth.register', compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.view');
    }
}
