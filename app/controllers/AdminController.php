<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Admin Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	
	public function postLogin()
	{
		echo Request::get('password');
		$username = Request::get('username');
		$password = Request::get('password');
		
		if (Auth::attempt(array('username' => $username, 'password' => $password)))
		{
		    return Redirect::intended('BusModel');
		}
		else
			return View::make('pages.Admin.login');
	
	}

	public function postLogout()
	{
		Auth::logout();
		return View::make('pages.Admin.login');
	}
}
