var map;
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();
var markers = [];
var category;
  // Set maps properties
function init(category) {
	
	var mapOptions = {
      //zoom: 10,
      //center: getCenter,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
     
	// Set id to display maps
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	
  	// Set url requst maps data

		var url = "home/get_marker?category="+category;
		
	// Get request data
    getRequest(url, function(data) {
         
        var data = JSON.parse(data.responseText);
    
        for (var i = 0; i < data.length; i++) {
            displayLocation(data[i]);
        }
			map.fitBounds(bounds);
    		map.panToBounds(bounds);
    });

     //styling the map
     var styleOptions = {
            name: "Dummy Style"
        };
        
        var MAP_STYLE = [
        {
            featureType: "road",
            elementType: "all",
            stylers: [
                { visibility: "on" }
            ]
        }
    ];
		
	var mapType = new google.maps.StyledMapType(MAP_STYLE, styleOptions);
        map.mapTypes.set("Dummy Style", mapType);
        map.setMapTypeId("Dummy Style");

}

// Display maps markers 
function displayLocation(location) {

    var content =   '<div class="infoWindow"><strong><u>'  + location.markers_name + '</u></strong>'
                    + '<br/>'     + location.markers_address + '</div>';
     
    if (parseInt(location.markers_lat) == 0) {
        geocoder.geocode( { 'address': location.markers_address }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                 
                var marker = new google.maps.Marker({
                    map: map,
					icon: "../images/pin/pin1.png",
                    position: results[0].geometry.location,
                    title: location.markers_name
                });
				
                bounds.extend(marker.position);
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                });
				markers.push(marker);
            }
        });
    } else {
         
        var position = new google.maps.LatLng(parseFloat(location.markers_lat), parseFloat(location.markers_lng));
        var marker = new google.maps.Marker({
            map: map,
			icon: "../images/pin/pin1.png",
            position: position,
            title: location.markers_name
        });
        bounds.extend(marker.position);		  
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(content);
            infowindow.open(map,marker);
        });
		markers.push(marker);
		
    }
	
}


function getRequest(url, callback) {
    var request;
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
    } else {
        request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
    }
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            callback(request);
        }
    }
    request.open("GET", url, true);
    request.send();
}