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
 * Class for bus manufacturer and type information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
use Illuminate\Cache\StoreInterface;
 
class BusModel implements IStorable
{
    /* -------------------------------------------------------------------------
     * Const
     */
    const BODYTYPE_UNDEFINED            = 0;
    const BODYTYPE_RIGID                = 1;
    const BODYTYPE_SINGLEDECK           = 2;
    const BODYTYPE_DOUBLEDECK           = 3;
    const BODYTYPE_ARTICULATED          = 4;
    
    
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $manufacturer;
    private $bodyType;
    private $entry;
    private $emissionStandard;
    private $modelName;
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($modelName)
    {
        $this->modelName    = $modelName;
        $this->bodyType     = self::BODYTYPE_UNDEFINED;
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
    
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }
    
    public function getBodyType()
    {
        return $this->bodyType;
    }
    
    public function setBodyType($bodyType)
    {
        switch (strtolower($bodyType))
        {
            case 1:
                $this->bodyType = self::BODYTYPE_RIGID;
                break;
            
            case 2:
                $this->bodyType = self::BODYTYPE_SINGLEDECK;
                break;
            
            case 3:
                $this->bodyType = self::BODYTYPE_DOUBLEDECK;
                break;
            
            case 4:
                $this->bodyType = self::BODYTYPE_ARTICULATED;
                break;
            
            default:
                $this->bodyType = self::BODYTYPE_UNDEFINED;
                break;
                }
    }
    
    public function getEntry()
    {
        return $this->entry;
    }
    
    public function setEntry($entry)
    {
        $this->entry = $entry;
    }
    
    public function getEmissionStandard()
    {
        return $this->emissionStandard;
    }
    
    public function setEmissionStandard($emissionStandard)
    {
        $this->emissionStandard = $emissionStandard;
    }
    
    public function saveToCacheForever()
    {
        if(Cache::has($this->modelName) == false)
        {
            Cache::forever($this->modelName, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }
    
    public function saveToORM($params)
    {
        $dbBusModel                         = new DBBusModel();
        $dbBusModel->modelName              = $this->modelName;
        $dbBusModel->manufacturer           = $this->manufacturer;
        $dbBusModel->bodyType               = $this->bodyType;
        $dbBusModel->entry                  = $this->entry;
        $dbBusModel->emissionStandard       = $this->emissionStandard;
        
        $dbBusModel->save();    
    }
}