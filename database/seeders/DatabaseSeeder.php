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
        // // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::statement('ALTER TABLE agama DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jeniskelamin DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE role DISABLE TRIGGER ALL;');
        // // DB::statement('ALTER TABLE user DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE title DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE personal DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE gedung DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE ruangan DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE golonganbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE bidangbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE kelompokbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE subkelompokbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE subsubkelompokbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jenispenggunaanbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE bahanbarang DISABLE TRIGGER ALL;');
        // // DB::statement('ALTER TABLE ukurangbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE kondisibarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE statusbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE statuspengajuan DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jenispengajuanbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE pengajuanbarang DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisdigunakan DISABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisdiperbaiki DISABLE TRIGGER ALL;');

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
        $this->call(SubSubKelompokBarangSeeder::class);
        $this->call(BahanBarangSeeder::class);
        $this->call(KondisiBarangSeeder::class);
        $this->call(UkuranBarangSeeder::class);
        $this->call(StatusBarangSeeder::class);
        $this->call(StatusPengajuanSeeder::class);
        $this->call(JenisPengajuanBarangSeeder::class);
        $this->call(JenisPenggunaanBarangSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InventarisBarangSeeder::class);

        // DB::statement('ALTER TABLE agama ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jeniskelamin ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE role ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE user ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE title ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE personal ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE gedung ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE ruangan ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE golonganbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE bidangbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE kelompokbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE subkelompokbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE subsubkelompokbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jenispenggunaanbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE bahanbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE ukurangbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE kondisibarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE statusbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE statuspengajuan ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE jenispengajuanbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE pengajuanbarang ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisdigunakan ENABLE TRIGGER ALL;');
        // DB::statement('ALTER TABLE inventarisdiperbaiki ENABLE TRIGGER ALL;');
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
