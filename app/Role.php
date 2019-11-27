<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_role');
    }

    protected $fillable = [
        'role'
    ];
}
