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
 * Class Bus
 *
 * Class for actual bus information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */

use Illuminate\Cache\StoreInterface;
    /* -------------------------------------------------------------------------
     * TODO Refactor this class using patterns
     * DONE See BusBuilder
     */
class Bus implements IStorable
{
    /* Retrieve BusModel object, BusOperator object and BusService object from MEMCACHED OR REDIS
        
        $objBusModel          = Cache::get($configs['busModel']);
        $objBusOperator       = Cache::get($configs['busOperator']);
        $objBusService        = Cache::get($configs['busService']);
        
     */
        
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $registration;
    private $busModel;
    private $busOperator;
    private $busService;
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($registration)
    {
        $this->registration    = $registration;
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    public function getRegistrationNumber()
    {
        return $this->registration;
    }
    
    public function getBusModel()
    {
        $objBusModel            = Cache::get($this->busModel);
        return $objBusModel;
    }
    
    public function setBusModel($busModel)
    {
        $this->busModel         = $busModel;
    }
    
    public function getBusOperator()
    {
        $objBusOperator         = Cache::get($this->busOperator);
        return $objBusOperator;
    }
    
    public function setBusOperator($busOperator)
    {
        $this->busOperator   = $busOperator;
    }
    
    public function getBusService()
    {
        $objBusService          = Cache::get('BusService-' . $this->busService);
        return $objBusService;
    }
    
    public function setBusService($busService)
    {
        $this->busService    = $busService;
    }
    
    public function saveToCacheForever()
    {
        if(Cache::has($this->registration) == false)
        {
            Cache::forever($this->registration, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }
    
    public function saveToORM($params)
    {
        
        $bus                    = new DBBus();
        $bus->registration      = $this->registration;
        $bus->dbbusmodel_id     = $params['dbbusmodel_id'];
        $bus->dbbusoperator_id  = $params['dbbusoperator_id'];
        $bus->dbbusservice_id   = $params['dbbusservice_id'];
        
        $bus->save();
    }
}
