<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRole = [
            [
                'nama' => 'Administrator',
                'aktif' => 1,
            ],
            [
                'nama' => 'User',
                'aktif' => 1,
            ],
            [
                'nama' => 'Management',
                'aktif' => 1,
            ],
        ];
        for ($i = 0; $i < count($dataRole); $i++) {
            Role::create($dataRole[$i]);
        }
    }
}
