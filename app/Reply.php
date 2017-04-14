<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $guarded = [];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function favorite(){
        return $this->morphMany(Favorite::class,'favorited');
    }

    public function doFavorite($uid){
        if(!$this->favorite()->where('user_id',$uid)->exists()){
        $this->favorite()->create([
            'user_id'=> $uid
        ]);
        }
    }
}
