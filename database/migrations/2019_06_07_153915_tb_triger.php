<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbTriger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('CREATE TRIGGER AIpendaftar AFTER INSERT ON `tb_pendaftar` FOR EACH ROW
                BEGIN
                   INSERT INTO `tb_user` (`email`, `username`, `password` , `hakAkses` , `remember_token` , `created_at`, `updated_at`) VALUES (NEW.email, NEW.username, NEW.password, \'siswa\' ,NEW.remember_token, NEW.created_at, NEW.updated_at);
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
        DB::unprepared('DROP TRIGGER `AIpendaftar`');
    }
}
