<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',array('as' => 'Home', function()
{
	return View::make('pages.index');
}));


/*
|--------------------------------------------------------------------------
| Commute Routes
|--------------------------------------------------------------------------
*/
//Route::get('View', array('as'=>'View', function()
//{
//	return View::make('pages.view');
//}));

Route::get('View', array('as'=>'View', 'uses' => 'ViewController@index'));

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/
Route::get('Login', array( 'as' => 'Login' ,  function()
{
	return View::make('pages.Admin.login');
}));

Route::post('Login', array('as' => 'postLogin', 'uses' => 'AdminController@postLogin'));

/*
|--------------------------------------------------------------------------
| Logout Routes
|--------------------------------------------------------------------------
*/
Route::get('Logout', array('as' => 'Logout', 'uses' => 'AdminController@postLogout'));

/*
|--------------------------------------------------------------------------
| Bus Routes
|--------------------------------------------------------------------------
*/
Route::get('Bus', array('as'=>'Bus', function()
{
	return View::make('pages.Admin.Bus');
}));

Route::post('Bus', array('as' => 'addBus', 'uses' => 'BusController@store'));

/*
|--------------------------------------------------------------------------
| Bus Location Routes
|--------------------------------------------------------------------------
*/
Route::get('BusLocation/{latitude}/{longitude}', array('as'=>'BusLocation', 'uses' => 'BusLocationController@index'));

//Route::post('BusLocation', array('as' => 'addBusLocation', 'uses' => 'BusLocationController@store'));

Route::post('BusLocation/{registration}/{latitude}/{longitude}/{timestamp}', array('as' => 'postBusLocation', 'uses' => 'BusLocationController@store'));

// Route group for API versioning
//Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
//{
//	Route::resource('BusLocation', 'BusLocationController');
//});

Route::group(array('prefix' => 'api/v1'), function()
{
	Route::resource('BusLocation', 'BusLocationController');
});

/*
|--------------------------------------------------------------------------
| Bus Model Routes
|--------------------------------------------------------------------------
*/
Route::get('BusModel', array('as'=>'BusModel', function()
{
	return View::make('pages.Admin.BusModel');
}));

Route::post('BusModel', array('as' => 'addBusModel', 'uses' => 'BusModelController@store'));

/*
|--------------------------------------------------------------------------
| Bus Operator Routes
|--------------------------------------------------------------------------
*/
Route::get('BusOperator', array('as'=>'BusOperator', function()
{
	return View::make('pages.Admin.BusOperator');
}));

Route::post('BusOperator', array('as' => 'addBusOperator', 'uses' => 'BusOperatorController@store'));

/*
|--------------------------------------------------------------------------
| Bus Route Routes
|--------------------------------------------------------------------------
*/
Route::get('BusRoute', array('as'=>'BusRoute', function()
{
	return View::make('pages.Admin.BusRoute');
}));

Route::post('BusRoute', array('as' => 'addBusRoute', 'uses' => 'BusRouteController@store'));

/*
|--------------------------------------------------------------------------
| Bus Service Routes
|--------------------------------------------------------------------------
*/
Route::get('BusService', array('as'=>'BusService', function()
{
	return View::make('pages.Admin.BusService');
}));

Route::post('BusService', array('as' => 'addBusService', 'uses' => 'BusServiceController@store'));

/*
|--------------------------------------------------------------------------
| Bus Stop Routes
|--------------------------------------------------------------------------
*/
//Route::get('BusStop', array('as'=>'BusStop', function()
//{
//	return View::make('pages.Admin.BusStop');
//}));

Route::post('BusStop', array('as' => 'addBusStop', 'uses' => 'BusController@store'));

Route::get('BusStop/{latitude}/{longitude}', array('as' => 'getETAForBusStop', 'uses' => 'BusStopController@show'));


// Route group for API versioning
Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
	Route::resource('BusStop', 'BusStopController');
});

