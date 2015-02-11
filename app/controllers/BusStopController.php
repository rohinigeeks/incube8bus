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
        const MAX_BUS_VIEW_RADIUS                     = 100000;
	
        /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $arrayLocations                     = array();
            $arrayDurations                     = array();
            $arrayTempDurations                 = array();
            
            
            
            $request 				= new DistanceMatrixRequest();
	    $distanceMatrix			= new DistanceMatrix(new CurlHttpAdapter());
	    
	    $busStop				= DBBusStop::find($id);
	    $latitude				= $busStop->latitude;
	    $longitude				= $busStop->longitude;
	    
	    $busStopLocation                    = new LatLng($latitude, $longitude);

            // Set your origins
            $request->setOrigins(array(new Coordinate($latitude, $longitude, true)));
            
            $request->setAvoidHighways(true);
            $request->setAvoidTolls(true);
            
            $request->setRegion('us');
            $request->setLanguage('en');
            $request->setTravelMode(TravelMode::DRIVING);
            $request->setUnitSystem(UnitSystem::METRIC);
            $request->setSensor(false);
            
            
	    $busLocations 		    = DB::Select("SELECT t.* FROM dbbuslocations t
						    INNER JOIN (
							SELECT registration, max(timestamp) AS Max FROM dbbuslocations
							GROUP BY registration
							) tm
							ON t.registration = tm.registration
							AND t.timestamp = tm.Max;");
    
            foreach($busLocations as $busLocation)
            {
		$registrationValue	    = $busLocation->registration;
		$busLatitude                = $busLocation->latitude;
		$busLongitude               = $busLocation->longitude;
		$busTimestamp               = $busLocation->timestamp;

		
		$busLocationInLatLng        = new LatLng($busLatitude, $busLongitude);
		
		$distance                   = SphericalGeometry::computeDistanceBetween($busStopLocation, $busLocationInLatLng);
		if($distance <= self::MAX_BUS_VIEW_RADIUS)
		{
		    //$arrayLocations[$registrationValue] = array($busLatitude, $busLongitude);
		    
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
			$duration               = $element->getDuration()->getText();
					
			$arrayTempDurations[]   = array('registration' => $registrationValue, 'duration' => $duration, 'timestamp' => $busTimestamp);
		    }
		    
		    usort($arrayTempDurations, array($this,"cmp"));
		    
		    $results = DB::select(
			"SELECT dbbusstops.id FROM dbbusstops JOIN dbbusroutes	ON dbbusstops.id = dbbusroutes.dbbusstop_id JOIN dbbusservices 	ON dbbusroutes.busRouteName = dbbusservices.busRouteName JOIN dbbus ON dbbusservices.id = dbbus.dbbusservice_id WHERE dbbus.registration = :param1 AND dbbusstops.id = :param2",
			array(
			'param1' => $registrationValue,
			'param2' => $id
		    ));
		    
		    //var_dump($results);
		    if($results[0] !=null)
		    {
			$arrayDurations[] = array('registration' => $registrationValue, 'duration' => $arrayTempDurations[0]['duration'], 'timestamp' => $arrayTempDurations[0]['timestamp']);
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
	*/
	
	
        
        

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
