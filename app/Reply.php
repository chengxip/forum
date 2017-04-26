<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordsActivity;
    //
    protected $guarded = [];
    protected $with = ['owner','favorite','thread'];

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

    public function isFavorited(){
        return $this->favorite->where('user_id',auth()->id())->count();
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }
}
