<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Events\UserRegistered;

Route::get('/sio',function(){
    return view('socket');
});

Route::get('/', function () {
    event(new UserRegistered(request('say')??'hello'));
    return ;
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Route::resource('threads','ThreadsController');
Route::get('/threads','ThreadsController@index');
Route::get('/threads/create','ThreadsController@create');
Route::get('/threads/{channel}','ThreadsController@index');
Route::get('/threads/{channel}/{thread}','ThreadsController@show');
Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy');

Route::post('/threads','ThreadsController@store');
Route::post('/threads/{channel}/{thread}/reply','RepliesController@store');

Route::post('/reply/{reply}/favorite','FavoriteController@store');
Route::get('/profile/{user}','ProfileController@show');

