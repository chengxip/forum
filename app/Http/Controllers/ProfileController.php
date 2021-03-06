<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(User $user){
        $activities = $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function($activity){
            return $activity->created_at->format('Y-m-d');
        });


        return view('user.profile',
            ['profile'=>$user,
            'activities'=> $activities,
            //'threads'=>$user->activity()->paginate(10),

        ]); 
    }
    
}
