<?php

class BusOperatorController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            
            $address                = new Address(Request::get('addressline1'), Request::get('addressline2'), Request::get('city'), Request::get('zipcode'), Request::get('country'));
            
            //Save to Cache
            $address->saveToCacheForever();
            
            //Save to DB
            $address->saveToORM(null);
            
            $dbAddress              = DBAddress::where('addressline1', Request::get('addressline1'))->firstOrFail();
            
            $blBusOperator          = new BusOperator(Request::get('companyname'));
            $blBusOperator->setContactEnquiry(Request::get('contactenquiry'));
            $blBusOperator->setContactHotline(Request::get('contacthotline'));
            $blBusOperator->setContactEmail(Request::get('contactemail'));
            $blBusOperator->setAddress($address);
            
            //Save to Cache
            $blBusOperator->saveToCacheForever();
            
            //Save to DB
            $blBusOperator->saveToORM($dbAddress->id);
            
            return View::make('pages.Admin.BusOperator');
	}


}
