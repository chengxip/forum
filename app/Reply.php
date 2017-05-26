<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
    //
    protected $guarded = [];
    protected $with = ['owner','favorite','thread'];
    protected $appends = ['favoriteCount','isFavorited'];

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

    public function unFavorite($uid){
         if($this->favorite()->where('user_id',$uid)->exists()){
            $this->favorite()->where([
                'user_id'=> $uid
            ])->get()->each->delete();
        }
    }

    public function isFavorited(){
        return !!$this->favorite->where('user_id',auth()->id())->count();
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }


    public function getFavoriteCountAttribute(){
        return $this->favorite->count();
    }

    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }
}
