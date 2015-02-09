<?php
/**
 * Bus Tracking App
 *
 * @copyright  incube8 2015
 * @package    incube8bus
 * @license    GNU/LGPL 
 * @filesource
 */
/**
 * Class BusModel
 *
 * Class for bus stop information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
use Illuminate\Cache\StoreInterface;
class BusStop implements IStorable
{
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $address;
    private $lat;
    private $lon;
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($address)
    {
        $this->address              = $address;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function getLatitude()
    {
        $response                   = Geocode::make()->address($this->address);

        if ($response) {
            $this->lat = $response->latitude();
            //echo $response->longitude();
            //echo $response->formattedAddress();
            //echo $response->locationType();
        }
        return $this->lat;
    }
    
    public function setLatitude($lat)
    {
        $this->lat = $lat;
    }
    
    public function getLongitude()
    {
        $response                   = Geocode::make()->address($this->address);

        if ($response) {
            $this->lon = $response->longitude();
            //echo $response->longitude();
            //echo $response->formattedAddress();
            //echo $response->locationType();
        }
        return $this->lon;
    }
    
    public function setLongitude($lon)
    {
        $this->lon = $lon;
    }
    
    //IStorable Interface Method Definitions
    
    public function saveToCacheForever()
    {
        if(Cache::has("BusStop-" . $this->address) == false)
        {
            Cache::forever("BusStop-" . $this->address, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }

    public function saveToORM($params)
    {
       
        $dbBusStop                  = new DBBusStop();
        $dbBusStop->address         = $this->address;
        $dbBusStop->latitude        = $this->lat;
        $dbBusStop->longitude       = $this->lon;
        
        $dbBusStop->save();    
    }
}