<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPaciente extends Model
{
    protected $table = 'estados_pacientes';
    protected $primaryKey = 'id_est';
    public $timestamps = true;
}
