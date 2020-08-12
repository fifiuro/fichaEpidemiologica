<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class establecimiento extends Model
{
    protected $table = 'establecimientos';
    protected $primaryKey = 'id_esp';
    public $timestamps = true;
}
