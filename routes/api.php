<?php

use Illuminate\Http\Request;

Route::post('register','Api\Auth\RegisterController@register');
//LOGIN API AUTH ROUTES
Route::post('login','Api\Auth\LoginController@login');
Route::post('refresh','Api\Auth\LoginController@refresh');

Route::middleware('auth:api')->group(function () {
	Route::post('logout','Api\Auth\LoginController@logout');
});
