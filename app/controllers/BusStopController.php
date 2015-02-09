<?php

use Ivory\GoogleMap\Base\Coordinate;
use Widop\HttpAdapter\CurlHttpAdapter;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;

class BusStopController extends \BaseController {
        
        /* -------------------------------------------------------------------------
         * Const
         */
        const MAX_BUS_VIEW_RADIUS                     = 10000;
	
        /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($latitude, $longitude)
	{
	    $redis                              = Redis::connection();
        
            $arrayLocations                     = array();
            $arrayDurations                     = array();
            $arrayTempDurations                 = array();
            
            $userLocation                       = new LatLng($latitude, $longitude);
            
            $request = new DistanceMatrixRequest();

            // Set your origins
            $request->setOrigins(array(new Coordinate($latitude, $longitude, true)));
            
            $request->setAvoidHighways(true);
            $request->setAvoidTolls(true);
            
            $request->setRegion('us');
            $request->setLanguage('en');
            $request->setTravelMode(TravelMode::DRIVING);
            $request->setUnitSystem(UnitSystem::METRIC);
            $request->setSensor(false);
            
            
            //Use Google Maps API to find all the bus locations at a specific distance the user
            $registrations                      = $redis->getall('registration');
            
            foreach($registrations as $registrationKey=>$registrationValue)
            {
                if(Cache::has('Location-' . $registrationValue))
                {
                    $blBusLocation              = Cache::get('Location-' . $registrationValue);
                    $busLatitude                = $blBusLocation->getLatitude();
                    $busLongitude               = $blBusLocation->getLongitude();
                    $busTimestamp               = $blBusLocation->getTimestamp();

                    
                    $busLocationInLatLng        = new LatLong($busLatitude, $busLongitude);
                    
                    $distance                   = SphericalGeometry::computeDistanceBetween($userLocation, $busLocationInLatLong);
                    if($distance <= MAX_BUS_VIEW_RADIUS)
                    {
                        $arrayLocations[$registrationValue] = array($busLatitude, $busLongitude);
                        
                        // Set your destinations
                        $request->setDestinations(array(new Coordinate($busLatitude, $busLongitude, true)));
                        
                        $response               = $distanceMatrix->process($request);
            
                        $rows                   = $response->getRows();
                        
                        // Get the rows
                        foreach ($rows as $row)
                        {
                            $elements           = $row->getElements();
                        }
                        foreach ($elements as $element)
                        {
                            // Get the duration
                            $duration               = $element->getDuration();
                            $arrayTempDurations[]   = array('registration' => $registrationValue, 'duration' => $duration, 'timestamp' => $busTimestamp);
                        }
                        
                        usort($arrayTempDurations, "cmp");
                        
                        $arrayDurations[$registrationValue] = $arrayTempDurations[0]['duration'];
                    }
                }
            }
            
            return Response::json(array('error' => false,'BusDurations' => $arrayDurations),200);
	}
        
        function cmp($a, $b)
        {
            $epsilon = 0.00001;

            if(abs($a["duration"]-$b["duration"]) < $epsilon)
            {
                return 1;
            }
            else
            {
                return -1;
            }
        }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
