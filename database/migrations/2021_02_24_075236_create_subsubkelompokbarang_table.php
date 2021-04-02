<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubKelompokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsubkelompokbarang', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('subkelompokbarang_id')
                ->constrained('subkelompokbarang')
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
        Schema::dropIfExists('subsubkelompokbarang');
    }
}
