<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';
    protected $primaryKey = 'id_est';
    public $timestamps = true;
}
