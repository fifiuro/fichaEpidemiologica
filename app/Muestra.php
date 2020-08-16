<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    protected $table = 'muestras';
    protected $primaryKey = 'id_mue';
    public $timestamps = true;
}
