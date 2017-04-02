<?php
namespace App\Filter;

use App\User;

class ThreadFilter extends Filter{

    protected $filters = ['by'];

    public function by($username){
        $user = User::where('name',$username)->firstOrFail();
        $this->query->where('user_id',$user->id);
    }
}
