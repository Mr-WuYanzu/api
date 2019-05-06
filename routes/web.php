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
    return view('welcome');
});
//获取用户信息
Route::get('curl/test','UserApiController@curl');
//POST
Route::get('curl/curlpost','UserApiController@curlPost');
//POST
Route::get('curl/curlpost1','UserApiController@curlPost1');
//POST
Route::get('curl/curlpost2','UserApiController@curlPost2');

Route::get('test/mid','UserApiController@testmid')->middleware('request');