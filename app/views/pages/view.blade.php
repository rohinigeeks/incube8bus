@extends('layouts.default')
<script src="http://maps.googleapis.com/maps/api/js"></script>
{{ HTML::script('http://maps.googleapis.com/maps/api/js') }}
{{-- HTML::script('js/View.js') --}}

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
    </div>
    
@stop
