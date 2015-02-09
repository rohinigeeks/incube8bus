<?php

class BusRouteController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            
            $BusStopAddress         = Request::get('busstopaddress');
            
            $busStop                = new BusStop($BusStopAddress);
            $busStop->setLatitude($busStop->getLatitude());
            $busStop->setLongitude($busStop->getLongitude());
            
            $busStop->saveToCacheForever();
            
            $busStop->saveToORM(null);
            
            $dbBusStop              = DBBusStop::where('address', $BusStopAddress)->firstOrFail();
            
            $blBusRoute             = new BusRoute(Request::get('busroutename'));
            
            //$blBusRoute->appendData(Request::get('order'),Request::get('road'), $busStop , Request::get('kmdistance'));
            
            //$blBusRoute->saveToCacheForever();
            
            $blBusRoute->saveToORM(array('Order' => Request::get('order'), 'Road' => Request::get('road'), 'BusStopId' => $dbBusStop->id, 'KMDistance' => Request::get('kmdistance')));
            
            return View::make('pages.Admin.BusRoute');
	}


}
