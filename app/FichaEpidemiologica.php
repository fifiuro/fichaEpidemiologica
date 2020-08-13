<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEpidemiologica extends Model
{
    protected $table = 'ficha_epidemiologica';
    protected $primaryKey = 'id_fe';
    public $timestamps = true;
}
