<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKelompokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subkelompokbarang', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('kelompokbarang_id')
                ->constrained('kelompokbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama');
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
        Schema::dropIfExists('subkelompokbarang');
    }
}
