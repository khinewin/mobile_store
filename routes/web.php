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

Route::get('/', [
    'uses'=>'AuthController@getLogin',
    'as'=>'/'
]);

Route::get('/login',[
    'uses'=>'AuthController@getLogin',
    'as'=>'login'
]);
Route::post('/login',[
    'uses'=>'AuthController@postLogin',
    'as'=>'login'
]);


Route::group(['middleware'=>'myRole:Admin'], function (){

    Route::get('/register',[
        'uses'=>'AuthController@getRegister',
        'as'=>'register'
    ]);
    Route::post('/register',[
        'uses'=>'AuthController@postRegister',
        'as'=>'register'
    ]);

    Route::get('/employees',[
        'uses'=>'HomeController@getEmployees',
        'as'=>'employees'
    ]);
    Route::post('/update-user-role',[
        'uses'=>'HomeController@postUpdateUserRole',
        'as'=>'update-user-role'
    ]);
    Route::post('/post-remove-user',[
        'uses'=>'HomeController@postRemoveUser',
        'as'=>'post-remove-user'
    ]);

});


Route::group(['middleware'=>'auth'], function (){
    Route::get('/user-image/{file_name}',[
        'uses'=>'HomeController@getUserImage',
        'as'=>'user-image'
    ]);
    Route::post('/user-image-upload', [
        'uses'=>'HomeController@postUploadUserImage',
        'as'=>'user-image.upload'
    ]);
    Route::get('profile',[
       'uses'=>'HomeController@getProfile',
        'as'=>'profile'
    ]);
    Route::get('/error',[
        'uses'=>'AuthController@getError',
        'as'=>'error'
    ]);

    Route::get('/logout',[
        'uses'=>'AuthController@getLogout',
        'as'=>'logout'
    ]);
    Route::get('/dashboard',[
        'uses'=>'HomeController@getDashboard',
        'as'=>'dashboard'
    ]);


});

