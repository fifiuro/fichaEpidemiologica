<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalNotifica extends Model
{
    protected $table = 'personal_notifica';
    protected $primaryKey = 'id_pn';
    public $timestamps = true;
}
