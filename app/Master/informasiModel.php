<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class informasiModel extends Model
{
    //
    protected $table = 'tb_informasi';
    protected $fillable = ['judul','isi','tanggal'];
}
