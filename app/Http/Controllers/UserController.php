<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Role;
use App\Models\JenisKelamin;
use App\Models\Agama;
use App\Models\Title;

class UserController extends Controller
{
    public function count()
    {
        return User::count();
    }
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Index';
        $data['page'] = 'User';
        $data['app'] = 'Assek App';

        $data['user'] = User::with([
            'personal.jeniskelamin',
            'personal.agama',
            'personal.title',
            'role',
        ])->get();
        $data['role'] = Role::where('aktif', 1)->get();
        $data['jenisKelamin'] = JenisKelamin::all();
        $data['agama'] = Agama::all();
        $data['title'] = Title::where('aktif', 1)->get();

        return view('pages.user.index', compact('data'));
    }
    public function detail(Request $request)
    {
        $data['user'] = User::find($request->id);
        return response()->json($data['user']);
    }
    public function show($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Detail';
        $data['page'] = 'User';
        $data['app'] = 'Assek App';

        $data['user'] = User::where('id', $id)->get();

        return view('pages.user.get', compact('data'));
    }
    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'User';
        $data['app'] = 'Assek App';

        $data['user'] = User::find($id);
        $data['role'] = Role::where('aktif', 1)->get();
        $data['jenisKelamin'] = JenisKelamin::all();
        $data['agama'] = Agama::all();
        $data['title'] = Title::where('aktif', 1)->get();

        return view('pages.user.edit', compact('data'));
    }

    public function editPribadi()
    {
        $data['layout'] = 'layouts.master';
        $data['subpage'] = 'Edit';
        $data['page'] = 'User';
        $data['app'] = 'Assek App';

        $data['user'] = User::find(Auth::user()->id);
        $data['role'] = Role::where('aktif', 1)->get();
        $data['jenisKelamin'] = JenisKelamin::all();
        $data['agama'] = Agama::all();
        $data['title'] = Title::where('aktif', 1)->get();

        return view('pages.user.profile', compact('data'));
    }

    public function update(Request $request)
    {
        if (
            $request->password === null &&
            $request->password_confirmation === null
        ) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'role_id' => 'required',
                'aktif' => 'required',
                'noinduk' => 'required',
                'tanggallahir' => 'required',
                'jeniskelamin_id' => 'required',
                'title_id' => 'required',
                'agama_id' => 'required',
                'notelepon' => 'required',
            ]);
            $user = User::where('id', $request->id)->update([
                'nama' => ucwords($request->nama),
                'email' => $request->email,
                'role_id' => $request->role_id,
                'aktif' => $request->aktif,
            ]);
            $personal = Personal::where('id', $request->id)->update([
                'noinduk' => $request->noinduk,
                'tanggallahir' => $request->tanggallahir,
                'jeniskelamin_id' => $request->jeniskelamin_id,
                'title_id' => $request->title_id,
                'agama_id' => $request->agama_id,
                'notelepon' => $request->notelepon,
            ]);
        } else {
            $validatedData = $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6',
                'role_id' => 'required',
                'aktif' => 'required',
                'noinduk' => 'required',
                'tanggallahir' => 'required',
                'jeniskelamin_id' => 'required',
                'title_id' => 'required',
                'agama_id' => 'required',
                'notelepon' => 'required',
            ]);
            $user = User::where('id', $request->id)->update([
                'nama' => ucwords($request->nama),
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
                'aktif' => $request->aktif,
            ]);
            $personal = Personal::where('id', $request->id)->update([
                'noinduk' => $request->noinduk,
                'tanggallahir' => $request->tanggallahir,
                'jeniskelamin_id' => $request->jeniskelamin_id,
                'title_id' => $request->title_id,
                'agama_id' => $request->agama_id,
                'notelepon' => $request->notelepon,
            ]);
        }
        if ($user && $personal) {
            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success_message',
                    'Data User ' . $request->nama . ' berhasil diubah!'
                );
        } else {
            return redirect()
                ->route('admin.user.edit', ['id' => $request->id])
                ->with('error_message', 'Data User gagal diubah!');
        }
    }

    public function updatePribadi(Request $request)
    {
        if (
            $request->password === null &&
            $request->password_confirmation === null
        ) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'role_id' => 'required',
                'aktif' => 'required',
                'noinduk' => 'required',
                'tanggallahir' => 'required',
                'jeniskelamin_id' => 'required',
                'title_id' => 'required',
                'agama_id' => 'required',
                'notelepon' => 'required',
            ]);
            $user = User::where('id', $request->id)->update([
                'nama' => ucwords($request->nama),
                'email' => $request->email,
                'role_id' => $request->role_id,
                'aktif' => $request->aktif,
            ]);
            $personal = Personal::where('id', $request->id)->update([
                'noinduk' => $request->noinduk,
                'tanggallahir' => $request->tanggallahir,
                'jeniskelamin_id' => $request->jeniskelamin_id,
                'title_id' => $request->title_id,
                'agama_id' => $request->agama_id,
                'notelepon' => $request->notelepon,
            ]);
        } else {
            $validatedData = $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6',
                'role_id' => 'required',
                'aktif' => 'required',
                'noinduk' => 'required',
                'tanggallahir' => 'required',
                'jeniskelamin_id' => 'required',
                'title_id' => 'required',
                'agama_id' => 'required',
                'notelepon' => 'required',
            ]);
            $user = User::where('id', $request->id)->update([
                'nama' => ucwords($request->nama),
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
                'aktif' => $request->aktif,
            ]);
            $personal = Personal::where('id', $request->id)->update([
                'noinduk' => $request->noinduk,
                'tanggallahir' => $request->tanggallahir,
                'jeniskelamin_id' => $request->jeniskelamin_id,
                'title_id' => $request->title_id,
                'agama_id' => $request->agama_id,
                'notelepon' => $request->notelepon,
            ]);
        }
        if ($user && $personal) {
            if (Auth::user()->role_id === 1) {
                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'success_message',
                        'Data User ' . $request->nama . ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 2) {
                return redirect()
                    ->route('user.dashboard')
                    ->with(
                        'success_message',
                        'Data User ' . $request->nama . ' berhasil diubah!'
                    );
            } elseif (Auth::user()->role_id === 3) {
                return redirect()
                    ->route('manajamen.dashboard')
                    ->with(
                        'success_message',
                        'Data User ' . $request->nama . ' berhasil diubah!'
                    );
            }
        } else {
            if (Auth::user()->role_id === 1) {
                # code...
                return redirect()
                    ->route('admin.user-profile.edit', ['id' => $request->id])
                    ->with('error_message', 'Data User gagal diubah!');
            } elseif (Auth::user()->role_id === 2) {
                # code...
                return redirect()
                    ->route('user.user-profile.edit', ['id' => $request->id])
                    ->with('error_message', 'Data User gagal diubah!');
            } elseif (Auth::user()->role_id === 3) {
                # code...
                return redirect()
                    ->route('management.user-profile.edit', [
                        'id' => $request->id,
                    ])
                    ->with('error_message', 'Data User gagal diubah!');
            }
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:user,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role_id' => 'required',
            'aktif' => 'required',
            'noinduk' => 'required',
            'tanggallahir' => 'required',
            'jeniskelamin_id' => 'required',
            'title_id' => 'required',
            'agama_id' => 'required',
            'notelepon' => 'required',
        ]);
        $user = User::create([
            'nama' => ucwords($request->nama),
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'aktif' => $request->aktif,
        ]);
        $personal = Personal::create([
            'user_id' => $user->id,
            'noinduk' => $request->noinduk,
            'tanggallahir' => $request->tanggallahir,
            'jeniskelamin_id' => $request->jeniskelamin_id,
            'title_id' => $request->title_id,
            'agama_id' => $request->agama_id,
            'notelepon' => $request->notelepon,
        ]);
        if ($user && $personal) {
            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success_message',
                    'Data User ' .
                        ucwords($request->nama) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('admin.user.index')
                ->with('error_message', 'Data User gagal ditambahkan!');
        }
    }
    public function destroy(Request $request)
    {
        $user = User::where('id', $request->delete_id)->delete();
        if ($user) {
            return redirect()
                ->route('admin.user.index')
                ->with('success_message', 'User berhasil dihapus!');
        } else {
            return redirect()
                ->route('admin.user.index')
                ->with('error_message', 'User gagal dihapus!');
        }
    }
}
