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
 * Class for bus route information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
use Illuminate\Cache\StoreInterface;
class BusRoute implements IStorable
{
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $busRoute                   = array();
    private $busRouteName;
    
    public function __construct($busRouteName)
    {
        $this->busRouteName             = $busRouteName;
    }
    
    public function appendData($order, $road, BusStop $objBusStop, $kmDistance)
    {
        $busStopAddress                 = $objBusStop->getAddress();
        
        $busRouteName                   = $this->busRouteName;
        
        $busRoute[$busRouteName][$busStopAddress]      = array('Order' => $order,'Road' => $road,'BusStop' => $objBusStop, 'KMDistance' => $kmDistance);
    }
    
    public function getBusRoute()
    {
        return $this->busRoute;
    }
    
    //IStorable Interface Method Definitions
    
    public function saveToCacheForever()
    {
        //if(Cache::has("Route#" . $busRouteName) == false)
        //{
            Cache::forever("Route-" . $this->busRouteName, $this);    
        //}
        
    }
    
    public function saveToCache($min)
    {
        //
    }

    public function saveToORM($params)
    {
        
       
        $dbBusRoute                          = new DBBusRoute();
        $dbBusRoute->busRouteName            = $this->busRouteName;
        $dbBusRoute->order                   = $params['Order'];
        $dbBusRoute->road                    = $params['Road'];
        $dbBusRoute->dbbusstop_id            = $params['BusStopId'];
        $dbBusRoute->kmDistance              = $params['KMDistance'];
        
        $dbBusRoute->save();    
    }
}