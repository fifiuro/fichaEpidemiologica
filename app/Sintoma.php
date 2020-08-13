<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table = 'sintomas';
    protected $primaryKey = 'id_sin';
    public $timestamps = true;
}
