<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuanbarang', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('jenispengajuanbarang_id')
                ->constrained('jenispengajuanbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('subsubkelompokbarang_id')
                ->constrained('subsubkelompokbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('statuspengajuan_id')
                ->constrained('statuspengajuan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('jumlahbarang');
            $table->bigInteger('estimasipenggunaan')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuanbarang');
    }
}
