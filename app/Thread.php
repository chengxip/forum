<?php

namespace App;

use App\Filter\ThreadFilter;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;
    protected $guarded = [];
    public static function boot(){
        parent::boot();
        static::addGlobalScope('replyCount',function($query){
            $query->withCount('replies');
        });

    }
   
    //
    public function path(){
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, ThreadFilter $filter){
        return  $filter->apply($query);
    }
}
