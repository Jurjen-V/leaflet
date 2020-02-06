<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Leaflet</title>
    <!-- cdn leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <link href="https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyB5FoasQwCg9CU7lUHnAq31xo8XfDBxVhk">
    <script src="https://cdn.osmbuildings.org/classic/0.2.2b/OSMBuildings-Leaflet.js"></script>  
    <script src="//cdn.jsdelivr.net/leaflet.esri/2.0.0-beta.7/esri-leaflet.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" /> -->
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

<!-- route -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.5/leaflet-routing-machine.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.5/leaflet-routing-machine.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/1.5.5/Control.Geocoder.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/1.5.5/Control.Geocoder.min.css">
</head>
<body>
<div class="span9" style="height:100%">
    <div id="map">
        <div class="leaflet-bottom leaflet-right button_box" style="display:inline-block;">
            <button type="button" id="Btn1" value="Osm" onclick="loadkaart('osm')" class="btnStyle span3 leaflet-control Button">3D</button>
            <button type="button" id="Btn2" value="Satellite" onclick="loadkaart('satellite')" class="btnStyle span3 leaflet-control Button" >Satellite</button> 
            <button type="button" id="Btn3" value="Kaart" onclick="loadkaart('normal')" class="btnStyle span3 leaflet-control Button" >Kaart</button>
        </div>
        <div class="leaflet-bottom leaflet-right button_box2">
            <button type="button" id="Btn4" value="" onclick="setview(current_position)" class="btnStyle span3 leaflet-control Button1"> <i class='material-icons'>my_location</i></button>
        </div>
    </div>
</div>
</body>
</html>
<style type="text/css">
    .leaflet-left{
        position: absolute;
        bottom: 0px;
        
    }
    .leaflet-top{
        width: 100%;
    }
  .button_box{
    position: absolute;
    right: 50px;
    bottom: 20px;
  }
  .button_box2{
    position: absolute ;
    right: 0px;
    bottom: 90px;
  }
  .Button, .Button1{
    background-color: white;
    border: none;
    color: black;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    clear: both ;
    display:inline-block ;
    float: none !important;
  }
  .Button1{
    padding: 5px;
  }
  .Button:hover, .Button1:hover{
    cursor: pointer;
    background-color:#4285f4;
    border: none;
    color: white;
  }
  .active {
      background-color: #4285f4;
      color: white;
  }
  body {
      padding: 0;
      margin: 0;
  }
  html, body, #map {
      height: 100%;
      width: 100vw;
  }
</style>
<script type="text/javascript">
var loadmap = 'normal';
var current_position , circle, polyline, marker;
var i = 0;
var map = new L.map('map',{
    zoom: 16,
    zoomControl: false,
}).fitWorld();
L.control.zoom({
     position:'bottomright'
}).addTo(map);
var osmb;
function loadkaart(loadmap){
    //osm
    if(loadmap == 'osm'){
        new L.TileLayer('https://api.mapbox.com/styles/v1/osmbuildings/cjt9gq35s09051fo7urho3m0f/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w', {
            // attribution: '© Map <a href="https://mapbox.com">Mapbox</a>',
            maxZoom: 20,
            maxNativeZoom: 18,
            minZoom: 5,
            zoom: 16,
        }).addTo(map);
        var osmb = new OSMBuildings(map).load('https://{s}.data.osmbuildings.org/0.2/anonymous/tile/{z}/{x}/{y}.json');
        var osm = document.getElementById("Btn1");
        var satellite = document.getElementById("Btn2");
        var normal = document.getElementById("Btn3");
        osm.disabled = true;
        satellite.disabled = false;
        normal.disabled = false;
        osm.classList.add("active");
        satellite.classList.remove("active");
        normal.classList.remove("active");
    }
    //satellite
    if(loadmap == 'satellite'){
        //remove old layers
        map.eachLayer(function (layer) {
        map.removeLayer(layer);
        });
        new L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            minZoom: 5,
            zoom: 16,
            // id: 'mapbox/streets-v11',
            id: 'mapbox/satellite-v9',
            accessToken: 'pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w'
        }).addTo(map);
        var osm = document.getElementById("Btn1");
        var satellite = document.getElementById("Btn2");
        var normal = document.getElementById("Btn3");
        osm.disabled = false;
        satellite.disabled = true;
        normal.disabled = false;
        osm.classList.remove("active");
        satellite.classList.add("active");
        normal.classList.remove("active");
    }
    //normal
    if(loadmap == 'normal'){
        //remove old layers
        map.eachLayer(function (layer) {
        map.removeLayer(layer);
        });
        new L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            minZoom: 5,
            zoom: 16,      
            id: 'mapbox/streets-v11',
            accessToken: 'pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w'
        }).addTo(map);
        var osm = document.getElementById("Btn1");
        var satellite = document.getElementById("Btn2");
        var normal = document.getElementById("Btn3");
        osm.disabled = false;
        satellite.disabled = false;
        normal.disabled = true;
        osm.classList.remove("active");
        satellite.classList.remove("active");
        normal.classList.add("active");
    }

    if (marker) {
        map.removeLayer(marker);
        console.log("REMOVE!");
    }
    
}

loadkaart(loadmap);
map.locate({watch: true, setView: false, maxZoom: 18, enableHighAccuracy: true});


function onLocationFound(e) {
    if(i == 0){
        map.panTo(new L.LatLng(e.latitude, e.longitude));
        i = i + 1;
    }
    var latlngs = Array();
    var radius = e.accuracy;
    if (current_position) {
        map.removeLayer(current_position);
        map.removeLayer(circle);
    }
//set location
    current_position = new L.circleMarker(e.latlng, {
        color: 'white',
        fillColor: '#4285f4',
        radius: 10,
        fillOpacity: 1,
    }).addTo(map);
    circle = new L.circleMarker(e.latlng, {
        color: '#d3e2f9',
        fillColor: '#d3e2f9',
        fillOpacity: 0.5,
        radius: 12
    }).addTo(map);
    map.addLayer(circle);
    map.addLayer(current_position);
}

//set vieuw on yourlocation
function setview(e){
    var latview = e._latlng.lat;
    var lngview = e._latlng.lng;
    map.panTo(new L.LatLng(latview, lngview));
}

//onlocationfound
map.on('locationfound', onLocationFound);
function onLocationError(e) {
    alert(e.message);
}

//on errors
map.on('locationerror', onLocationError);

//onclick map
//set marker
    map.on('click', function (position) {
      if (marker) {
        map.removeLayer(marker);
      }
      marker = new L.Marker(position.latlng).addTo(map);
      marker.dragging.disable()
      marker.dragging.enable();
    });
// search
 var searchControl = new L.esri.Controls.Geosearch().addTo(map);
  var results = new L.LayerGroup().addTo(map);

  searchControl.on('results', function(data){
    results.clearLayers();
    for (var i = data.results.length - 1; i >= 0; i--) {
      results.addLayer(L.marker(data.results[i].latlng));
    }
  });
//schaal
  L.control.scale().addTo(map);

//route
// var control = L.Routing.control({
//   router: new L.Routing.osrmv1({
//     language: 'en',
//     profile: 'car'
//   }),
//   geocoder: L.Control.Geocoder.nominatim({})
// }).addTo(map);
// routing
var control = L.Routing.control({
  router: new L.Routing.osrmv1({
    language: 'nl',
    profile: 'car'
  }),
   lineOptions : {
        addWaypoints: false
    },
  geocoder: L.Control.Geocoder.nominatim({})
}).addTo(map);


</script>
