<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id');
            $table->string('room_id');
            $table->string('namapemesan');
            $table->string('emailpemesan');
            $table->string('jk');
            $table->string('tlpn');
            $table->string('pekerjaan');
            $table->string('status');
            $table->string('jumlah');
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
        Schema::dropIfExists('pesan_kamars');
    }
}
