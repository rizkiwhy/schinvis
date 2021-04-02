<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Personal;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataUser = [
            [
                'nama' => '-',
                'email' => 'default@assek.com',
                'password' => bcrypt('assek'),
                'role_id' => 1,
                'aktif' => 1,
            ],
            [
                'nama' => 'Administrator',
                'email' => 'admin@assek.com',
                'password' => bcrypt('assek'),
                'role_id' => 1,
                'aktif' => 1,
            ],
            [
                'nama' => 'Aiki',
                'email' => 'aiki@assek.com',
                'password' => bcrypt('assek'),
                'role_id' => 2,
                'aktif' => 1,
            ],
            [
                'nama' => 'Management',
                'email' => 'management@assek.com',
                'password' => bcrypt('assek'),
                'role_id' => 3,
                'aktif' => 1,
            ],
        ];

        $dataPersonal = [
            [
                'tanggallahir' => '2000-02-02',
                'jeniskelamin_id' => 1,
                'title_id' => 1,
                'agama_id' => 1,
                'notelepon' => '081208120810',
            ],
            [
                'tanggallahir' => '2000-02-02',
                'jeniskelamin_id' => 1,
                'title_id' => 1,
                'agama_id' => 1,
                'notelepon' => '081208120811',
            ],
            [
                'tanggallahir' => '2000-02-02',
                'jeniskelamin_id' => 1,
                'title_id' => 1,
                'agama_id' => 1,
                'notelepon' => '081208120812',
            ],
            [
                'tanggallahir' => '2000-02-02',
                'jeniskelamin_id' => 1,
                'title_id' => 1,
                'agama_id' => 1,
                'notelepon' => '081208120813',
            ],
        ];

        for ($i = 0; $i < count($dataUser); $i++) {
            $user = User::create($dataUser[$i]);
            $personal = Personal::create([
                'user_id' => $user->id,
            ])
                ->where('user_id', $user->id)
                ->update($dataPersonal[$i]);
            $personal = Personal::all();
            $personal = Personal::where('user_id', $user->id)->update([
                'noinduk' =>
                    str_replace('-', '', $personal[$i]->tanggallahir) .
                    date('Ym') .
                    $personal[$i]->jeniskelamin_id .
                    sprintf('%03s', $i + 1),
            ]);
        }
    }
}
