<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personal');
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('noinduk')->nullable();
            $table->date('tanggallahir')->nullable();
            $table
                ->foreignId('jeniskelamin_id')
                ->nullable()
                ->constrained('jeniskelamin')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('title_id')
                ->nullable()
                ->constrained('title')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('agama_id')
                ->nullable()
                ->constrained('agama')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('notelepon')->nullable();
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
        Schema::dropIfExists('personal');
    }
}
