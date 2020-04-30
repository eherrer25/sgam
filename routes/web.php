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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function(){

    Route::get('home','HomeController@index')->name('home');

    Route::prefix('users')->group(function(){
        Route::get('list','UserController@listUsers')->name('users-list');
        Route::get('new','UserController@newUser')->name('user-new');
        Route::post('new','UserController@createUser')->name('user-create');
        Route::get('edit/{id}','UserController@editUser')->name('user-edit');
        Route::put('update','UserController@updateUser')->name('user-update');
        Route::delete('delete/{id}','UserController@deleteUser')->name('user-delete');
    });

});


