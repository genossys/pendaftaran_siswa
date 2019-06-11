<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrigerDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('CREATE TRIGGER ADpendaftar AFTER DELETE ON `tb_pendaftar` FOR EACH ROW
                BEGIN
                    DELETE FROM `tb_user` WHERE `tb_user`.`username` = OLD.username;
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared('DROP TRIGGER `ADpendaftar`');
    }
}
