<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTersediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaristersedia', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('inventarisbarang_id')
                ->constrained('inventarisbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('ruangan_id')
                ->constrained('ruangan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('inventaristersedia');
    }
}
