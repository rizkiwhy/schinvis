<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('gedung_id')
                ->constrained('gedung')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama');
            $table->string('luas');
            $table->string('koridor_depan');
            $table->string('koridor_belakang');
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
        Schema::dropIfExists('ruangan');
    }
}
