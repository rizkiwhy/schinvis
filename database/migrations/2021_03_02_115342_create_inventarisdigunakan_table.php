<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisDigunakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarisdigunakan', function (Blueprint $table) {
            $table->id();
            $table->string('nopengajuan')->nullable();
            $table
                ->foreignId('inventarisbarang_id')
                ->constrained('inventarisbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('jenispenggunaanbarang_id')
                ->constrained('jenispenggunaanbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('ruangan_id')
                ->constrained('ruangan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('mulaidigunakan')->nullable();
            $table->date('selesaidigunakan')->nullable();
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
        Schema::dropIfExists('inventarisdigunakan');
    }
}
