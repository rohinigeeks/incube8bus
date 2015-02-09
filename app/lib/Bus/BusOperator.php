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
 * Class for bus operator information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */

use Illuminate\Cache\StoreInterface;
class BusOperator implements IStorable
{
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $companyName;
    private $objAddress             = null;
    private $contactEnquiry;
    private $contactHotline;
    private $contactEmail;
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($companyName)
    {
        $this->companyName    = $companyName;
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    public function getAddress()
    {
        return $this->objAddress->toString();
    }
    
    public function setAddress(Address $objAddress)
    {
        $this->objAddress = $objAddress;
    }
    
    public function getContactHotline()
    {
        return $this->contactHotline;
    }
    
    public function setContactHotline($contactHotline)
    {
        $this->contactHotline = $contactHotline;
    }
    
    public function getContactEnquiry()
    {
        return $this->contactEnquiry;
    }
    
    public function setContactEnquiry($contactEnquiry)
    {
        $this->contactEnquiry = $contactEnquiry;
    }
    
     public function getContactEmail()
    {
        return $this->contactEmail;
    }
    
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }
    
    //IStorable Interface Method Definitions
    
    public function saveToCacheForever()
    {
        if(Cache::has($this->companyName) == false)
        {
            Cache::forever($this->companyName, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }

    public function saveToORM($params)
    {
       
        $dbBusOperator                          = new DBBusOperator();
        $dbBusOperator->companyName             = $this->companyName;
        $dbBusOperator->contactHotline          = $this->contactHotline;
        $dbBusOperator->contactEnquiry          = $this->contactEnquiry;
        $dbBusOperator->contactEmail            = $this->contactEmail;
        $dbBusOperator->address_id              = $params;
        
        $dbBusOperator->save();    
    }
}