<?php

namespace App\Listeners;

use Cache;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Auth\Events\Registered;

class SendRegisterMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //Cache::put('message',$event->msg,10);
        $user = $event->user ; //\App\User::where('name','kik')->first();
        if(is_a ($user,'\\App\\User')){
            var_dump($user);
            $mail = new \App\Mail\WelcomeMail($user);
            \Mail::to($user)->send($mail);
        }
    }
}
