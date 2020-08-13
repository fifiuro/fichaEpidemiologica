<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnfermedadesBase extends Model
{
    protected $table = 'enfermedades_base';
    protected $primaryKey = 'id_eb';
    public $timestamps = true;
}
