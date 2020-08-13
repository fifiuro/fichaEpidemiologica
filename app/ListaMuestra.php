<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaMuestra extends Model
{
    protected $table = 'listas_muestras';
    protected $primaryKey = 'id_lm';
    public $timestamps = true;
}
