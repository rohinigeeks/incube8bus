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
 * Interface IStorable
 *
 * Interface for cache or Object Relational Model/Eloquent storage contract for an object
 * 
 * @copyright  incube8 2015
 * @package    incube8bus
 */
interface IStorable {
    
	/**
	 * Store an item in the cache indefinitely.
	 *
	 * @return void
	 */
	public function saveToCacheForever();
        
        /**
	 * Store an item in the cache for a given number of minutes.
	 *
	 * @param  int     $minutes
	 * @return void
	 */
	public function saveToCache($minutes);
        
        /**
	 * Store an Business Layer object in the Eloquent Model for db operations.
	 *
	 * @param  mixed     $params
	 * @return void
	 */
        public function saveToORM($params);

}
