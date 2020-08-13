<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'ocupaciones';
    protected $primaryKey = 'id_ocu';
    public $timestamps = true;
}
