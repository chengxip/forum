<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('store');
    }
    //
    public function store(Reply $reply){
        $reply->doFavorite(auth()->id());
    }
}
