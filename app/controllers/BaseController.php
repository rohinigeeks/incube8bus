<?php

class BaseController extends Controller {

	protected $userLatitude;
	protected $userLongitude;

	public function __construct()
	{
		if (Input::has('latitude'))
			$this->userLatitude = Input::get('latitude');
			
		if (Input::has('longitude'))
			$this->userLongitude = Input::get('longitude');
	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	


}
