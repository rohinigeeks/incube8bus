@extends('layouts.default')

{{ HTML::script('http://maps.googleapis.com/maps/api/js') }}

{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}

@section('content')
    <script>
        
        function showPosition(position)
        {
            var myCenter=new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var mapProp = {
              center:myCenter,
              zoom:15,
              mapTypeId:google.maps.MapTypeId.ROADMAP
              };
            
            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
            
            var marker=new google.maps.Marker({
              position:myCenter,
              });
            
            marker.setMap(map);
            
            //alert(position.coords.latitude);
            //alert(position.coords.longitude);
            
            $('[name="userLatitude"]').val(position.coords.latitude);
            $('[name="userLongitude"]').val(position.coords.longitude);
            
            var url = "http://localhost:8000/api/v1/BusLocation?latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;
            
            downloadUrl(url, function(json_result){
                
                var image = {
                    url: 'img/beachflag.png',
                    
                    size: new google.maps.Size(20, 32),
                    
                    origin: new google.maps.Point(0,0),
                    
                    anchor: new google.maps.Point(0, 32)
                  };
                  
                  var shape = {
                      coords: [1, 1, 1, 20, 18, 20, 18 , 1],
                      type: 'poly'
                  };
                var obj = jQuery.parseJSON(json_result);
                var arrBusLocations = obj.BusLocations;
                
                for (i=0; i < arrBusLocations.length; i++) {
                    
                    var lat = arrBusLocations[i]['latitude'];
                    var lng = arrBusLocations[i]['longitude'];
                    
                    var busLocationMarker = new google.maps.LatLng(lat,lng);
                    
                    var marker=new google.maps.Marker({
                        position:busLocationMarker,
                        map: map,
                        icon: image,
                        shape: shape,
                    });
                      
                    //marker.setMap(map);
                    
                    
                }
            });      
        }
        
        function doNothing() {}
        
        function downloadUrl(url,callback)
        {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;
           
            request.onreadystatechange = function() {
                
              if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request.responseText, request.status);
              }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function initialize()
        {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else { 
                alert("Geolocation is not supported by this browser.");
            }
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div class="neighborhood-guides">
        <div class="container">
            <div class="col-md-12">
                <h3>Commute</h3>
                <p>View which buses are near you.</p>
                <div id="googleMap" style="width:500px;height:380px;"></div>
            </div>
        <div>
        {{ Form::open(array('action' => 'View', 'role' => 'form', 'id' => 'ViewForm')); }}
            {{ Form::hidden('userLatitude'); }}
            {{ Form::hidden('userLongitude'); }}    
        {{ Form::close() }}
    </div>
    
@stop
