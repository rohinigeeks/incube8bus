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
class Address
{
    private $addressLine1;
    private $addressLine2;
    private $city;
    private $zipCode;
    private $country;
    
    public function __construct($addressLine1, $addressLine2, $city, $zipCode, $country)
    {
        $this->addressLine1          = $addressLine1;
        $this->addressLine2          = $addressLine2;
        $this->city                  = $city;
        $this->zipCode               = $zipCode;
        $this->country               = $country;
    }
    
    public function toString()
    {
        $dump                       = "";
        if($this->addressLine1)
            $dump                   = $this->addressLine1 . " ";
        if($this->addressLine2)
            $dump                   = $this->addressLine2 . " ";
        if($this->city)
            $dump                   = $this->city         . " ";
        if($this->zipCode)
            $dump                   = $this->zipCode      . " ";
        if($this->country)
            $dump                   = $this->country;
            
        return $dump;
    }
    
    public function saveToCacheForever()
    {
        if(Cache::has('Address-' . $this->addressLine1) == false)
        {
            Cache::forever('Address-' . $this->addressLine1, $this);    
        }
        
    }
    
    public function saveToCache($min)
    {
        //
    }

    public function saveToORM($params)
    {
       
        $dbAddress                          = new DBAddress();
        $dbAddress->addressLine1            = $this->addressLine1;
        $dbAddress->addressLine2            = $this->addressLine2;
        $dbAddress->city                    = $this->city;
        $dbAddress->zipCode                 = $this->zipCode;
        $dbAddress->country                 = $this->country;
        
        $dbAddress->save();    
    }
}