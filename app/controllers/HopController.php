<?php
use Widop\HttpAdapter\CurlHttpAdapter;
use GuzzleHttp\Client;
class HopController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $arrResult                  = null;
	    return View::make('pages.hop', array('arrResult' => $arrResult));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
                   
            $arrResult                  = null;
            
	    $busStopId                  = Request::get('busstop');
            
            $client                     = new GuzzleHttp\Client(['base_url' => 'http://ec2-52-0-153-33.compute-1.amazonaws.com']);
            $result                     = $client->get('/api/v1/BusStop/' . $busStopId);
            
            $arrResult                  = $result->json();
            
            //var_dump($result->json());
            
        
            View::share('arrResult', $arrResult);
            
            return View::make('pages.hop', array('arrResult' => $arrResult));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
        
        /*
        file_get_contents can do a POST, create a context for that first:

        $opts = array('http' =>
          array(
            'method'  => 'POST',
            'header'  => "Content-Type: text/xml\r\n".
              "Authorization: Basic ".base64_encode("$https_user:$https_password")."\r\n",
            'content' => $body,
            'timeout' => 60
          )
        );
                                
        $context  = stream_context_create($opts);
        $url = 'https://'.$https_server;
        $result = file_get_contents($url, false, $context, -1, 40000);
        */


}
