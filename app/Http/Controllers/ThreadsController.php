<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Thread;
use App\Filter\ThreadFilter;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct(){
        //$this->middleware('auth')->only('store');
        $this->middleware('auth')->only(['store','create','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,ThreadFilter $filter)
    {
        $threads = Thread::with('channel')->filter($filter)->latest();
        if($channel->exists){
            $threads = $threads->where('channel_id',$channel->id); 
        } 
        $threads = $threads->get();

        if(request()->wantsJson()){
            return $threads;
        }

        $viewdata = [
            'threads' => $threads,
        ];
        return view('threads.index',$viewdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //if(auth()->user()->can('newpost'))

        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'channel_id'=>'required|exists:channels,id',
        ]);
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id'=> request('channel_id'),
            'title'=> request('title'),
            'body'=> request('body'),
        ]);
        return redirect($thread->path())->with('flash','you thread have been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel,Thread $thread)
    {
        //
        $viewdata = [
            'thread'=>$thread,
            //'replies'=>$thread->replies()->paginate(10)
        ];
        return view('threads.show',$viewdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        //
        $this->authorize('update', $thread);

        //$thread->replies()->delete();
        $thread->delete();
        if(request()->wantsJson()){
            return response([], 204);
        }else{
            return redirect('/threads');
        }
    }
}
