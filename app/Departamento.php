<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos_estados';
    protected $primaryKey = 'id_dep';
    public $timestamps = true;
}
