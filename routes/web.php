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
//测试中间件
Route::get('test/mid','UserApiController@testmid')->middleware('request');
//用户注册
Route::post('test/reg','user\UserController@reg');
//用户登录
Route::post('test/login','user\UserController@login');
//用户中心
Route::get('test/my','user\UserController@My')->middleware(['checklogin','request']);