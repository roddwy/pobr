<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::resource('typeusers','TypesUsersController');
	Route::get('typeusers/{id}/destroy',[
		'uses'	=>	'TypesUsersController@destroy',
		'as'	=>	'admin.typeusers.destroy'
	]);

	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses'	=>	'UsersController@destroy',
		'as'	=>	'admin.users.destroy'
	]);

	Route::resource('ownerscurrents', 'OwnersCurrentsController');
	Route::get('ownerscurrents/{id}/destroy',[
		'uses'	=>	'OwnersCurrentsController@destroy',
		'as'	=>	'admin.ownerscurrents.destroy'
	]);

	Route::resource('categories', 'CategoriesController');
	Route::get('categories/{id}/destroy',[
		'uses'	=>	'CategoriesController@destroy',
		'as'	=>	'admin.categories.destroy'
	]);

	Route::resource('typesproperties', 'TypesPropertiesController');
	Route::get('typesproperties/{id}/destroy',[
		'uses'	=>	'TypesPropertiesController@destroy',
		'as'	=>	'admin.typesproperties.destroy'
	]);

	Route::resource('zones', 'ZonesController');
	Route::get('zones/{id}/destroy',[
		'uses'	=>	'ZonesController@destroy',
		'as'	=>	'admin.zones.destroy'
	]);

	Route::resource('states', 'StateController');
	Route::get('states/{id}/destroy',[
		'uses'	=>	'StateController@destroy',
		'as'	=>	'admin.states.destroy'
	]);
});

Route::get('admin/auth/login', [
	'uses'	=>	'Auth\AuthController@getLogin',
	'as'	=>	'admin.auth.login'
]);
Route::post('admin/auth/login', [
	'uses'	=>	'Auth\AuthController@postLogin',
	'as'	=>	'admin.auth.login'

]);	
Route::get('admin/auth/logout', [
	'uses'	=>	'Auth\AuthController@getLogout',
	'as'	=>	'admin.auth.logout'
]);