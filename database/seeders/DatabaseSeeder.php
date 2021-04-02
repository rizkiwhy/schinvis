<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AgamaSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TitleSeeder::class);
        $this->call(GedungSeeder::class);
        $this->call(RuanganSeeder::class);
        $this->call(GolonganBarangSeeder::class);
        $this->call(BidangBarangSeeder::class);
        $this->call(KelompokBarangSeeder::class);
        $this->call(SubKelompokBarangSeeder::class);
        $this->call(BahanBarangSeeder::class);
        $this->call(KondisiBarangSeeder::class);
        $this->call(UkuranBarangSeeder::class);
        $this->call(StatusBarangSeeder::class);
        $this->call(StatusPengajuanSeeder::class);
        $this->call(JenisPengajuanBarangSeeder::class);
        $this->call(JenisPenggunaanBarangSeeder::class);
        $this->call(InventarisBarangSeeder::class);
        $this->call(UserSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
