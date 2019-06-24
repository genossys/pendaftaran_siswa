<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_pendaftar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username', '25')->unique();
            $table->string('password');
            $table->string('nama', '255');
            $table->text('alamat');
            $table->date('tglLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->string('namaOrtu', '255');
            $table->string('noHp', '25');
            $table->enum('status',['menunggu','terima','tolak']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tb_informasi', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('judul','255');
            $table->text('isi');
            $table->date('tanggal');
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
        //
        Schema::dropIfExists('tb_pendaftar');
        Schema::dropIfExists('tb_informasi');
    }
}
