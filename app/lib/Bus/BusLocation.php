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
 * Class BusLocation
 *
 * Class for bus location
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
class BusLocation
{
    /* WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING
     *
     * PHP always gives the server time. So use new DateTime() judiciously
     *
     * The timestamp here is coming from the bus location push mechanism.
     * There is a queueing mechanism for the bus location push mechanism.
     * So the timestamp here is elapsed. You have to compare time before using it.
     *
     * BusLocation are only cached to MEMCACHED and not stored into the db because
     * its a fickle of matter when this object is required.
     *
     * EITHER NEW VERSION OF DATA COMES IN FUTURE
     * OR IT IS TOO OLD TO KEEP BUT JUST NEEDED FOR THE SAKE OF CALCULATING VELOCITY
     * 
     */
    
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    private $_registration;
    private $_latitude;
    private $_longitude;
    private $_timestamp;
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($_registration, $latitude, $longitude, $timestamp)
    {
        //TODO REFACTOR Remove Bus object and use Registration Number from Bus object instead.
        
        //$this->_bus             = $bus;
        $this->_registration    = $_registration;
        $this->_timestamp       = $timestamp;
        $this->_latitude        = $latitude;
        $this->_longitude       = $longitude;
    }
    
    public function getBus()
    {
        $bus                    = Cache::get($_registration);
        return $bus;
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    
    public function getRegistration()
    {
        return $this->_registration;
    }
    
    public function getLatitude()
    {
        return $this->_latitude;
    }
    
    public function getLongitude()
    {
        return $this->_longitude;
    }
    
    public function getTimestamp()
    {
        return $this->_timestamp;
    }
}    
