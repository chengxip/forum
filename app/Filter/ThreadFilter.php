<?php
namespace App\Filter;

use App\User;

class ThreadFilter extends Filter{

    protected $filters = ['by','popular'];

    public function by($username){
        $user = User::where('name',$username)->firstOrFail();
        $this->query->where('user_id',$user->id);
    }

    public function popular($popular){
        $this->query->getQuery()->orders = [];
        $this->query->orderby('replies_count','desc');
    }
}
