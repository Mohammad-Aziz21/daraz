<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//          P R O D U C T S
Route::get('/update_products/{id}','UserController@products');

//          O R D E R S
Route::get('/update_orders/{id}','UserController@orders');

//          H O M E

Route::get('/home','ViewController@homepage');


//          A C C O U N T S

Route::get('/account/{account_email}/{status}','ViewController@filteraccount');
Route::get('/profit/{account_email}','ViewController@profit');
Route::get('/procurement/{OrderId}','ViewController@procurement');

Route::post('/insert','ViewController@storeprocurement');
?>
