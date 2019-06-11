<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class pendaftarModel extends Model
{
    //
    protected $table ='tb_pendaftar';
    protected $fillable = ['id','email','username','password','nama','alamat','tglLahir','jenisKelamin','namaOrtu','noHp','status','urlFoto'];

}
