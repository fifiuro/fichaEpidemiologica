<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menor extends Model
{
    protected $table = 'menores';
    protected $primaryKey = 'id_men';
    public $timestamps = true;
}
