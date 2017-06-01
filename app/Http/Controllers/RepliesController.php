<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    //
    //
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    public function index($channel, Thread $thread){
        return $thread->replies()->paginate(2);
    }

    public function store($channel,Thread $thread){
        $this->validate(request(),[
            'body'=>'required',
        ]);
        $reply = $thread->addReply(
            [
                'body'=> request('body'),
                'user_id'=> auth()->id(),
            ]);
        if(request()->expectsJson()){
            return $reply->load('owner');
        }
        return back()->with('flash','your reply left');
    }

    public function destroy(Reply $reply){
        $this->authorize('update', $reply);
        $reply->delete();    
        //return back()->with('flash','Reply removed');
    }

    public function update(Reply $reply){
        $this->authorize('update', $reply);
        $reply->update(['body' => request('body')]);    
    }
}
