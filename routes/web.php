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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/weixin/valid', 'UserController@valid');
Route::get('/weixin/api', 'Api\ApiController@test');

Route::get('/weixin/menu', 'Weixin\WeixinController@viewMenu');
Route::post('/weixin/passmenu', 'Weixin\WeixinController@passMenu');

Route::post('/u/ulogin', 'User\LoginRegister@ulogin');//App登录逻辑
Route::post('/u/uregister', 'User\LoginRegister@uregister');//App注册逻辑

Route::get('/u/login', 'User\LoginRegister@login'); //登录页面展示
Route::get('/u/register', 'User\LoginRegister@register'); //登录页面展示