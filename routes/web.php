<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    try {
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $users = Http::withToken($token)->get('http://127.0.0.1:8000/api/users')->json();
            if ($users['status'] == true) {
                return view('users.index')->with('users', $users);
            }
    }catch (Exception $e){
        return redirect('login');
    }

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
        Route::get('createuser', ['as' => 'pages.createuser', 'uses' => 'App\Http\Controllers\PageController@createuser']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
Route::get('createuser', ['as' => 'pages.createuser', 'uses' => 'App\Http\Controllers\PageController@createuser']);
Route::get('createnoticia', ['as' => 'pages.createnoticia', 'uses' => 'App\Http\Controllers\PageController@createnoticia']);
Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);

Route::post('/store', [UserController::class, 'store'])->name('user.store');
Route::put('/update', [UserController::class, 'update'])->name('user.update');
Route::get('/destroy', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');


Route::post('/noticia', [\App\Http\Controllers\NoticiaController::class, 'store'])->name('noticia.store');
Route::resource('noticias', 'App\Http\Controllers\NoticiaController', ['except' => ['show']]);
Route::get('noticia', ['as' => 'noticias.edit', 'uses' => 'App\Http\Controllers\NoticiaController@update']);
Route::get('noticia', ['as' => 'noticias.edit', 'uses' => 'App\Http\Controllers\NoticiaController@edit']);
Route::put('noticia', [\App\Http\Controllers\NoticiaController::class, 'update'])->name('noticia.update');
Route::get('/noticia/destroy', [\App\Http\Controllers\NoticiaController::class, 'destroy'])->name('noticia.destroy');
