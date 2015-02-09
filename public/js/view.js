
    
function showPosition(position) {
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

