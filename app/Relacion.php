<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    protected $table = 'relacion';
    protected $primaryKey = 'id_rel';
    public $timestamps = true;
}
