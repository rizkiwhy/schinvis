<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarisbarang', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('subsubkelompokbarang_id')
                ->constrained('subsubkelompokbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->bigInteger('noregister');
            $table->string('merekmodel');
            $table->string('noseri')->nullable();
            $table->string('ukuran');
            $table
                ->foreignId('ukuranbarang_id')
                ->constrained('ukuranbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('bahanbarang_id')
                ->constrained('bahanbarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->year('tahunpembuatan');
            $table->date('tanggalpembelian');
            $table
                ->foreignId('kondisibarang_id')
                ->constrained('kondisibarang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('statusbarang_id')
                ->constrained('statusbarang')
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
        Schema::dropIfExists('inventarisbarang');
    }
}
