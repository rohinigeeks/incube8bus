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
 * Class BusBuilder
 *
 * Class for bus manufacturer and type information
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */

class BusBuilder
{
    /* -------------------------------------------------------------------------
     * TODO Refactor this class using patterns
     */

        
    /* -------------------------------------------------------------------------
     * Vars
     */
    // Information
    protected $_bus = NULL;
    protected $_configs = array();
    
    /* -------------------------------------------------------------------------
     * Basic functions
     */
    public function __construct($registration, $configs)
    {
        $this->_bus         = new Bus($registration);
        $this->_configs     = $configs;
    }
    
    public function build()
    {
        $busModel           = $this->_configs['busModelName'];
        $busOperator        = $this->_configs['busOperatorName'];
        $busService         = $this->_configs['busServiceName'];
        
        $this->_bus->setBusModel($busModel);
        $this->_bus->setBusOperator($busOperator);
        $this->_bus->getBusService($busService);
    }
    
    /* -------------------------------------------------------------------------
     * Getter / Setter for informations
     */
    public function getBus()
    {
        return $this->_bus;
    }
}