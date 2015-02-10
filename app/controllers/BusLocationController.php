<?php

use Carbon\Carbon;

class BusLocationController extends \BaseController {

    /* -------------------------------------------------------------------------
     * Const
     */
    const BUSLOCATION_CACHE_EXPIRATION            = 10;
    const MAX_BUS_VIEW_RADIUS                     = 10000;
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         //$latitude                           = Input::get('latitude');
        //$longitude                          = Input::get('longitude');
        
        //From BaseController
        $latitude                           = $this->userLatitude;
        $longitude                          = $this->userLongitude;
        
        $redis                              = Redis::connection();
        
        $arrayLocations                     = array();
        
        $userLocation                       = new LatLng($latitude, $longitude);
        
        //Use Google Maps API to find all the bus locations at a specific distance the user
        //$registrations                    = $redis->getall('registration');
        
        $DBBuses                            = DBBus::all();
        
        /*foreach($DBBuses as $DBBus)
        {
            $registrationValue              = $DBBus->registration;
            echo $registrationValue;
            if(Cache::has('Location-' . $registrationValue))
            {
                $blBusLocation              = Cache::get('Location-' . $registrationValue);
                $busLatitude                = $blBusLocation->getLatitude();
                $busLongitude               = $blBusLocation->getLongitude();
                
                $busLocationInLatLng        = new LatLng($busLatitude, $busLongitude);
                
                $distance                   = SphericalGeometry::computeDistanceBetween($userLocation, $busLocationInLatLong);
                if($distance <= MAX_BUS_VIEW_RADIUS)
                {
                    $arrayLocations = array($busLatitude, $busLongitude);
                }
            }
        }*/
        
        //$busLocations = DBBusLocation::whereRaw('timestamp = (select registration, max(timestamp) as Max from dbbuslocations group by registration) tm ')->get();
        
        $busLocations = DB::Select("SELECT t.* FROM dbbuslocations t
                                    INNER JOIN (
                                        SELECT registration, max(timestamp) AS Max FROM dbbuslocations
                                        GROUP BY registration
                                        ) tm
                                        ON t.registration = tm.registration
                                        AND t.timestamp = tm.Max;");
        
        return Response::json(array('error' => false,'BusLocations' => $busLocations),200);
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
        $redis                              = Redis::connection();
       
        $registration                       = Request::get('registration');
        $dbBus                              = DBBus::where('registration', $registration)->firstOrFail();
        
        $dbBusLocation                      = new DBBusLocation;
        $dbBusLocation->registration        = Request::get('registration');
        $dbBusLocation->latitude            = Request::get('latitude');
        $dbBusLocation->longitude           = Request::get('longitude');
        $dbBusLocation->timestamp           = Request::get('timestamp');
        $dbBusLocation->bus_id              = $dbBus->id;
        
        //Business Layer object
        $blBusLocation                      = new BusLocation($registration, Request::get('latitude'), Request::get('longitude'), Request::get('timestamp'));
        
        //Save to the MEMCACHED
        $expiresAt = Carbon::now()->addMinutes(self::BUSLOCATION_CACHE_EXPIRATION);
        if(Cache::has("Location-" . $registration))
        {
            //Remove the old one from cache and insert new location
            Cache::forget("Location-" . $registration);
            Cache::put("Location-" . $registration, $blBusLocation, $expiresAt);
        }
        else
        {
            Cache::add("Location-" . $registration, $blBusLocation, $expiresAt);
            
            //To save querying the database for registration list each time bus location is fetched from the API
            //$redis->hset('registration', $registration, $registration);
        }
        
        //Save to the DB
        $dbBusLocation->save();
        
        return Response::json(array('error' => false,'BusLocations' => $dbBusLocation->toArray()),200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        //$latitude                           = Input::get('latitude');
        //$longitude                          = Input::get('longitude');
        
        //From BaseController
        $latitude                           = $this->userLatitude;
        $longitude                          = $this->userLongitude;
        
        $redis                              = Redis::connection();
        
        $arrayLocations                     = array();
        
        $userLocation                       = new LatLng($latitude, $longitude);
        
        //Use Google Maps API to find all the bus locations at a specific distance the user
        //$registrations                    = $redis->getall('registration');
        
        //$DBBuses                            = DBBus::all();
        //
        //foreach($DBBuses as $DBBus)
        //{
        //    $registrationValue              = $DBBus->registration;
        //    echo $registrationValue;
        //    if(Cache::has('Location-' . $registrationValue))
        //    {
        //        $blBusLocation              = Cache::get('Location-' . $registrationValue);
        //        $busLatitude                = $blBusLocation->getLatitude();
        //        $busLongitude               = $blBusLocation->getLongitude();
        //        
        //        $busLocationInLatLng        = new LatLong($busLatitude, $busLongitude);
        //        
        //        $distance                   = SphericalGeometry::computeDistanceBetween($userLocation, $busLocationInLatLong);
        //        if($distance <= MAX_BUS_VIEW_RADIUS)
        //        {
        //            $arrayLocations[$registrationValue] = array($busLatitude, $busLongitude);
        //        }
        //    }
        //}
        
        //$busLocations = DBBusLocation::whereRaw('timestamp = (select registration, max("timestamp") from DBBusLocation group by registration)')->get();
        $busLocations = DBBusLocation::all();
        
        return Response::json(array('error' => false,'BusLocations' => $busLocations->toArray()),200);
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
