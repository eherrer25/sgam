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

    //Listar cuidados de residentes
    Route::get('show-nursings','ResidentNursingController@showNursings')->name('show-nursings');

//    Route::get('show-nursings','HomeController@showNursings')->name('show-nursings');
//    Route::post('save-nursings','HomeController@saveNursings')->name('save-nursings');

    Route::middleware('role:admin')->prefix('users')->group(function(){
        Route::get('list','UserController@listUsers')->name('users-list');
        Route::get('new','UserController@newUser')->name('user-new');
        Route::post('new','UserController@createUser')->name('user-create');
        Route::get('edit/{id}','UserController@editUser')->name('user-edit');
        Route::put('update/{id}','UserController@updateUser')->name('user-update');
        Route::delete('delete/{id}','UserController@deleteUser')->name('user-delete');
    });

    Route::prefix('clients')->group(function(){
        Route::get('list','ClientController@listClients')->name('clients-list');
        Route::get('new','ClientController@newClient')->name('client-new');
        Route::post('new','ClientController@createClient')->name('client-create');
        Route::get('edit/{id}','ClientController@editClient')->name('client-edit');
        Route::put('update/{id}','ClientController@updateClient')->name('client-update');
        Route::delete('delete/{id}','ClientController@deleteClient')->name('client-delete');
    });

    Route::prefix('residents')->group(function(){
        Route::get('list','ResidentController@listResidents')->name('residents-list');
        Route::get('new','ResidentController@newResident')->name('resident-new');
        Route::post('new','ResidentController@createResident')->name('resident-create');
        Route::get('edit/{id}','ResidentController@editResident')->name('resident-edit');
        Route::put('update/{id}','ResidentController@updateResident')->name('resident-update');
        Route::delete('delete/{id}','ResidentController@deleteResident')->name('resident-delete');

        Route::get('record/{id}','RecordController@recordResident')->name('resident-record');
        Route::post('record','RecordController@saveRecord')->name('new-record');
        Route::post('update-record','RecordController@editRecord')->name('edit-record');
    });

    Route::prefix('nursings')->group(function(){
        Route::get('list','NursingController@listNursings')->name('nursings-list');
        Route::get('new','NursingController@newNursing')->name('nursing-new');
        Route::post('new','NursingController@createNursing')->name('nursing-create');
        Route::get('edit/{id}','NursingController@editNursing')->name('nursing-edit');
        Route::put('update/{id}','NursingController@updateNursing')->name('nursing-update');
        Route::delete('delete/{id}','NursingController@deleteNursing')->name('nursing-delete');
    });


});


