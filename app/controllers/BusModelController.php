<?php

class BusModelController extends BaseController {
	/**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
       public function store()
       {
            $blBusModel             = new BusModel(Request::get('modelname'));
           
            $blBusModel->setEntry(Request::get('entry'));
            $blBusModel->setBodyType(Request::get('bodytype'));
            $blBusModel->setManufacturer(Request::get('manufacturer'));
            $blBusModel->setEmissionStandard(Request::get('emissionstandard'));
            
            //Save to Cache
            $blBusModel->saveToCacheForever();
            
            //Save to DB
            $blBusModel->saveToORM(null);
            
            return View::make('pages.Admin.BusModel');
       }
}
