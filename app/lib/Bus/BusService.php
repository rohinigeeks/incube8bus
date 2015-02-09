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
 * Class BusService
 *
 * Class for bus route information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
use Illuminate\Cache\StoreInterface;
class BusService implements IStorable
{
    /* -------------------------------------------------------------------------
     * Const
     */
    const SERVICETYPE_BASIC             = 0;
    const SERVICETYPE_BASICPLUS         = 1;
    const SERVICETYPE_PREMIUM           = 2;
    const SERVICETYPE_CITYDIRECT        = 3;

    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $busRouteName;
    private $serviceName;
    private $serviceType;
    private $start;
    private $end;
    
    
    /* TODO BREAK THE INHERITANCE AND IMPLEMENT LATER
     * private $objBusRoute;
     * private $direction;
     *
     */
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    
    /* -------------------------------------------------------------------------
     * TODO BREAK THE INHERITANCE AND IMPLEMENT LATER
     *  public function __construct($serviceName, $serviceType, $start, $end, $direction, BusRoute $objBusRoute)
        {
            $this->serviceName              = $serviceName;
            $this->start                    = $start;
            $this->end                      = $end;
            $this->direction                = $direction;
            $this->objBusRoute              = $objBusRoute;
            
            switch (strtolower($serviceType))
            {
                case "basic plus":
                    $this->serviceType      = SERVICETYPE_BASICPLUS;
                    break;
                case "premium":
                    $this->serviceType      = SERVICETYPE_PREMIUM;
                    break;
                case "city direct":
                    $this->serviceType      = SERVICETYPE_CITYDIRECT;
                    break;
                default:
                    $this->serviceType      = SERVICETYPE_BASIC;
                    break;
                
            }
        }
     *
     */
    public function __construct($serviceName, $busRouteName, $serviceType, $start, $end)
    {
        
        $this->serviceName              = $serviceName;
        $this->start                    = $start;
        $this->end                      = $end;
        $this->busRouteName             = $busRouteName;
        
        switch ($serviceType)
        {
            case 1:
                $this->serviceType      = self::SERVICETYPE_BASICPLUS;
                break;
            case 2:
                $this->serviceType      = self::SERVICETYPE_PREMIUM;
                break;
            case 3:
                $this->serviceType      = self::SERVICETYPE_CITYDIRECT;
                break;
            default:
                $this->serviceType      = self::SERVICETYPE_BASIC;
                break;
            
        }
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }
    
    public function getStart()
    {
        return $this->start;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
    
    public function getBusRoute()
    {
        return $this->busRouteName;
    }
    
    
    public function getServiceType()
    {
        return $this->serviceType;
    
    }
    
    //IStorable Interface Method Definitions
    
    public function saveToCacheForever()
    {
        if(Cache::has("BusService-" . $this->serviceName) == false)
        {
            Cache::forever("BusService-" . $this->serviceName, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }

    public function saveToORM($params)
    {
       $busService                              = new DBBusService();
       $busService->serviceName                 = $this->serviceName;
       $busService->busRouteName                = $this->busRouteName;
       $busService->start                       = $this->start;
       $busService->end                         = $this->end;
       $busService->serviceType                 = $this->serviceType;
       
       $busService->save();
    }
}