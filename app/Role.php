<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'user_role';

    public function user() {
        return $this->hasOne('App\User');
    }
}
