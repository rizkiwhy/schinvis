<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisDiperbaikiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarisdiperbaiki', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('inventarisbarang_id')
                ->constrained('inventarisbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('jenispengajuanbarang_id')
                ->constrained('jenispengajuanbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('statuspengajuan_id')
                ->constrained('statuspengajuan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('masalah')->nullable();
            $table->string('estimasiperbaikan')->nullable();
            $table->date('mulaiperbaikan')->nullable();
            $table->date('selesaiperbaikan')->nullable();
            $table->string('solusi')->nullable();
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
        Schema::dropIfExists('inventarisdiperbaiki');
    }
}
