<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function users(){
        return $this->belongsToMany(User::class,'t_user_role','f_role','f_user');
    }
}
