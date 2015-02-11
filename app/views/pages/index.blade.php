@extends('layouts.default')
@section('content')
     <div class="jumbotron">
      <div class="container">
        <h1>Commuting Made Easy in Singapore with incube8bus.</h1>
        <p>Hop onto any bus running on Singapore Routes and get to your destination.</p>
        <a href="#">Learn More</a>
      </div>
    </div> 
    <div class="neighborhood-guides">
        <div class="container">
            <h2>Meet new incube8bus ></h2>
            <p>Not sure which bus to hop? We've created bus guide for Singapore for easy commute.</p>
            <div class="row">
	            <div class="col-md-4">
	                <div class="thumbnail">
                      <img src="img/thumbnail1.jpg" width="360" height="165" >
                    </div>
                    
	            </div>
	            <div class="col-md-4">
	                <div class="thumbnail">
                      <img src="img/thumbnail2.jpg" width="360" height="165" >
                    </div>
                    
	            </div>
	            <div class="col-md-4">
	                <div class="thumbnail">
                      <img src="img/thumbnail3.jpg" width="360" height="165" >
                    </div>
	            </div>
	       </div>     
        </div>
    </div>
    <div class="learn-more">
	  <div class="container">
	    <div class="row">
                <div class="col-md-4">
                          <h3>Commute</h3>
                          <p>View which buses are near you.</p>
                          <p><a href="{{ URL::route("View", null) }}">See how to commute with incube8bus.</a></p>
                </div>
                <div class="col-md-4">
			<h3>Hop</h3>
			<p>Getting to know the ETA of a bus service is easy.</p>
			<p><a href="{{ URL::route("Hop", null) }}">Know when next bus is arriving.</a></p>
		  </div>
		  <div class="col-md-4">
			<h3>Trust and Safety</h3>
			<p>With our customer support team, we've got your back.</p>
			<p><a href="#">Learn about trust at incube8bus.</a></p>
		  </div>
	    </div>
	  </div>
	</div>
 
@stop