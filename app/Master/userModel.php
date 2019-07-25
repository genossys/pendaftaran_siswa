<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    //
    protected $table ='tb_user';
    protected $fillable = ['id','email','username','password','hakAkses'];

}
