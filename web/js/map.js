var map;

// Google Maps API

function initMap() {
    $.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k", function(success) {
        apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    })
    .fail(function(err) {
        alert("API Geolocation error!");
    }); 

    var apiGeolocationSuccess = function(position) {

        var mapDiv = document.getElementById("map-canvas");
        var map = new google.maps.Map(mapDiv, {
            center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        google.maps.event.addListener(map, "bounds_changed", function(e) {
            console.log("click: ", e);
        });
    }; 
}