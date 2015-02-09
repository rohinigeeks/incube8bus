<?php

class BusServiceController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $blBusService           = new BusService(Request::get('servicename'), Request::get('busroutename'), Request::get('servicetype'), Request::get('start'), Request::get('end'));
            
            $blBusService->saveToCacheForever();
            
            $blBusService->saveToORM(null);
            
            return View::make('pages.Admin.BusService');
	}


}
