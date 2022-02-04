<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemptransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temptransaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('apoteker_id');
            $table->foreignId('obat_id');
            $table->integer('banyak');
            $table->integer('sub_total');
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
        Schema::dropIfExists('temptransaksi');
    }
}
