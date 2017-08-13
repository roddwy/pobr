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

Route::get('/', [
	'uses'	=>	'PrincipalController@index',
	'as'	=>	'welcome'
]);
Route::get('detailproperty/{id}', [
	'uses'	=>	'PrincipalController@show',
	'as'	=>	'detailproperty'
]);
Route::get('search',[
	'uses'	=>	'PrincipalController@search',
	'as'	=>	'search'
]);
Route::get('sale',[
	'uses'	=>	'PrincipalController@sale',
	'as'	=>	'sale'
]);
Route::get('customers',[
		'uses'	=>	'CustomersController@create',
		'as'	=>	'customers'
]);
Route::post('customercreate',[
		'uses'	=>	'CustomersController@store',
		'as'	=>	'customercreate'
]);
Route::post('newCustomer','CustomersController@newCustomer');
Route::post('editCustomer','CustomersController@editCustomer');
Route::get('buscadorCustomer',array('as'=>'buscadorCustomer', 'uses'=>'CustomersController@buscadorCustomer'));


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

	Route::group(['middleware'=>'admin'],function(){
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
		Route::get('properties/{id}/destroy',[
			'uses'	=>	'PropertiesController@destroy',
			'as'	=>	'admin.properties.destroy'
		]);
		Route::get('reports', [
			'uses'	=>	'ReportsController@index',
			'as'	=>	'admin.reports'
		]);
		Route::get('reportegeneral',[
			'uses'	=>	'ReportsController@reportegeneral',
			'as'	=>	'admin.reportegeneral'
		]);
		Route::get('reportevendido',[
			'uses'	=>	'ReportsController@reportevendidos',
			'as'	=>	'admin.reportevendido'
		]);
		Route::get('reporteactivo',[
			'uses'	=>	'ReportsController@reporteactivos',
			'as'	=>	'admin.reporteactivo'
		]);
		Route::get('reporteinactivo',[
			'uses'	=>	'ReportsController@reporteinactivos',
			'as'	=>	'admin.reporteinactivo'
		]);
		Route::get('reporteoferta',[
			'uses'	=>	'ReportsController@reporteofertas',
			'as'	=>	'admin.reporteoferta'
		]);
		Route::get('reporteusuariototal',[
			'uses'	=>	'ReportsController@reporteusuariototal',
			'as'	=>	'admin.reporteusuariototal'
		]);
		Route::get('reporteusuariovendido',[
			'uses'	=>	'ReportsController@reporteusuariovendido',
			'as'	=>	'admin.reporteusuariovendido'
		]);
		Route::get('reporteclientes',[
			'uses'	=>	'ReportsController@reporteclientes',
			'as'	=>	'admin.reporteclientes'
		]);
		/*REPORTE PDF*/
		Route::get('reportegeneralpdf',[
			'uses'	=>	'ReportsController@reportegeneralpdf',
			'as'	=>	'admin.reportegeneralpdf'
		]);
		Route::get('reportevendidospdf',[
			'uses'	=>	'ReportsController@reportevendidospdf',
			'as'	=>	'admin.reportevendidospdf'
		]);
		Route::get('reporteactivopdf',[
			'uses'	=>	'ReportsController@reporteactivospdf',
			'as'	=>	'admin.reporteactivopdf'
		]);
		Route::get('reporteinactivopdf',[
			'uses'	=>	'ReportsController@reporteinactivospdf',
			'as'	=>	'admin.reporteinactivopdf'
		]);
		Route::get('reporteofertapdf',[
			'uses'	=>	'ReportsController@reporteofertaspdf',
			'as'	=>	'admin.reporteofertapdf'
		]);
	});
	Route::resource('ownerscurrents', 'OwnersCurrentsController');
			Route::get('ownerscurrents/{id}/destroy',[
				'uses'	=>	'OwnersCurrentsController@destroy',
				'as'	=>	'admin.ownerscurrents.destroy'
	]);
	Route::resource('properties', 'PropertiesController');
	Route::get('properties/{id}/create',[
		'uses'	=>	'PropertiesController@create',
		'as'	=>	'admin.properties.create'
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