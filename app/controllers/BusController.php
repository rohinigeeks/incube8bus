<?php

class BusController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $array                  = array('busModelName' => Request::get('busmodel'),'busOperatorName' => Request::get('busoperator'),'busServiceName' => Request::get('busservice'));
	    $busBuilder             = new BusBuilder(Request::get('registration'),$array);
            $busBuilder->build();
            
            $bus                    = $busBuilder->getBus();
            
            $bus->saveToCacheForever();
            
            $param                  = array();
            
            $dbBusModel             = DBBusModel::where('modelName', Request::get('busmodel'))->firstOrFail();
            $dbBusModelId           = $dbBusModel->id;
            
            $dbBusOperator          = DBBusOperator::where('companyName', Request::get('busoperator'))->firstOrFail();
            $dbBusOperatorId        = $dbBusOperator->id;
            
            $dbBusService           = DBBusService::where('serviceName', Request::get('busservice'))->firstOrFail();
            $dbBusServiceId         = $dbBusService->id;
            
            $param                  = array('dbbusmodel_id' => $dbBusModelId, 'dbbusoperator_id' => $dbBusOperatorId,'dbbusservice_id' => $dbBusServiceId);
            
            $bus->saveToORM($param);
            
            return View::make('pages.Admin.Bus');
	}


}
