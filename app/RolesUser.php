<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    protected $fillable = [
        'rol_id', 'user_id'
    ];
}
