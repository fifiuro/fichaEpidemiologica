<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    protected $table = 'antecedentes';
    protected $primaryKey = 'id_ant';
    public $timestamps = true;
}
