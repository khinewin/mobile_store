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
    Route::get('/detail/{id}',[
        'uses'=>'ReportController@getDetail',
        'as'=>'detail'
    ]);
    Route::get('/print/{id}',[
        'uses'=>'ReportController@getPrint',
        'as'=>'print'
    ]);
    Route::get('/search-by-date',[
        'uses'=>'ReportController@getSearchByDate',
        'as'=>'search-by-date'
    ]);
    Route::get('/report',[
        'uses'=>'ReportController@getReport',
        'as'=>'report'
    ]);
    Route::post('/checkout',[
        'uses'=>'CartController@postCheckout',
        'as'=>'checkout'
    ]);
    Route::post('/edit-payment',[
        'uses'=>'CartController@postEditPayment',
        'as'=>'edit_payment'
    ]);

    Route::get('/remove/item/{id}',[
        'uses'=>'CartController@getRemoveItem',
        'as'=>'remove.item'
    ]);

    Route::post('/add-to-cart',[
        'uses'=>'CartController@postAddToCart',
        'as'=>'add_to_cart'
    ]);
    Route::get('/sale',[
        'uses'=>'CartController@getSale',
        'as'=>'sale'
    ]);
    Route::post('/barcode',[
        'uses'=>'ProductController@getBarcode',
        'as'=>'get-barcode'
    ]);
    Route::get('/products',[
        'uses'=>'ProductController@getProducts',
        'as'=>'products'
    ]);
    Route::post('/new-product',[
        'uses'=>'ProductController@postNewProduct',
        'as'=>'new-product'
    ]);
    Route::get('/new-product',[
        'uses'=>'ProductController@getNewProduct',
        'as'=>'new-product'
    ]);
    Route::post('/new-cat',[
        'uses'=>'ProductController@postNewCat',
        'as'=>'new_cat'
    ]);
    Route::get('/categories',[

        'uses'=>'ProductController@getCategory',
        'as'=>'categories'
    ]);
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

