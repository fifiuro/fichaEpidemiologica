<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
    protected $table = 'hospitalizaciones';
    protected $primaryKey = 'id_hos';
    public $timestamps = true;
}
