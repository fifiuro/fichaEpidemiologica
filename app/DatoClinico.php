<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatoClinico extends Model
{
    protected $table = 'datos_clinicos';
    protected $primaryKey = 'id_dc';
    public $timestamps = true;
}
