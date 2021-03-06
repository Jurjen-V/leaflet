document.getElementById("Btn6").style.display = "none";
document.getElementById("route-narrative").style.display = "none";
document.getElementById("Btn10").style.display = "none";
document.getElementById("Btn12").style.display = "none";
var current_position,
  circle,
  polyline,
  marker,
  dir,
  value,
  value2,
  clicked2,
  i,
  e,
  osmb;
var checkrijden = false;
var routelayertest, LayerGroup10;
var loadmap = "normal";
var i = 0;
var clicked = false;
var map = new L.map("map", {
  layers: MQ.mapLayer(),
  zoom: 15,
  zoomControl: false
}).fitWorld();
L.control
  .zoom({
    position: "bottomright"
  })
  .addTo(map);
//function loadmap
function loadkaart(loadmap) {
  //osm
  if (loadmap == "osm") {
    new L.TileLayer(
      "https://api.mapbox.com/styles/v1/osmbuildings/cjt9gq35s09051fo7urho3m0f/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w",
      {
        // attribution: '© Map <a href="https://mapbox.com">Mapbox</a>',
        maxZoom: 20,
        maxNativeZoom: 18,
        minZoom: 5,
        zoom: 16
      }
    ).addTo(map);
    osmb = new OSMBuildings(map).load(
      "https://{s}.data.osmbuildings.org/0.2/anonymous/tile/{z}/{x}/{y}.json"
    );
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
  if (loadmap == "satellite") {
    if (osmb) {
      map.removeLayer(osmb);
    }
    new L.tileLayer(
      "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
      {
        // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        minZoom: 5,
        zoom: 16,
        // id: 'mapbox/streets-v11',
        id: "mapbox/satellite-v9",
        accessToken:
          "pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w"
      }
    ).addTo(map);
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
  if (loadmap == "normal") {
    //remove old layers
    if (osmb) {
      map.removeLayer(osmb);
    }
    new L.tileLayer(
      "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
      {
        // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        minZoom: 5,
        zoom: 16,
        id: "mapbox/streets-v11",
        accessToken:
          "pk.eyJ1Ijoib3NtYnVpbGRpbmdzIiwiYSI6IjNldU0tNDAifQ.c5EU_3V8b87xO24tuWil0w"
      }
    ).addTo(map);
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
}
map.setZoom(16);
loadkaart(loadmap);

map.locate({
  watch: true,
  setView: false,
  maxZoom: 18,
  enableHighAccuracy: true
});

function onLocationFound(e) {
  if (i == 0) {
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
    color: "white",
    fillColor: "#4285f4",
    radius: 10,
    fillOpacity: 1
  }).addTo(map);
  circle = new L.circleMarker(e.latlng, {
    color: "#d3e2f9",
    fillColor: "#d3e2f9",
    fillOpacity: 0.5,
    radius: 12
  }).addTo(map);

  map.addLayer(circle);
  map.addLayer(current_position);
}
//set vieuw on yourlocation
function setview(e) {
  var latview = e._latlng.lat;
  var lngview = e._latlng.lng;
  map.panTo(new L.LatLng(latview, lngview));
}
//onlocationfound
map.on("locationfound", onLocationFound);
function onLocationError(e) {
  alert(e.message);
}
//on errors
map.on("locationerror", onLocationError);
//onclick
$("html").on("click", function() {
  clicked = false;
  value = "niks!";
  $("Button").click(function() {
    clicked2 = true;
    value2 = $("Button").val();
  });

  $("Route").click(function() {
    console.log("Clicked!");
  });
});

map.on("click", function(e) {
  e = e;
  if (!clicked2 == "" && !value2 == "") {
    test(clicked2, e);
    value2 = "";
    clicked2 = "";
  } else {
    test(clicked, e);
  }
});

//setmarker
function test(clicked, e) {
  if (clicked == false) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = new L.Marker(e.latlng).addTo(map);
    marker.dragging.disable();
    marker.dragging.enable();
  }
  if (clicked == true) {
    // console.log("btn dus geen marker!");
  }
}
//zoekbalk
var sidenav = L.map("sidenav", { zoomControl: false });
var searchControl = new L.esri.Controls.Geosearch().addTo(sidenav);
var list, index;
list = document.getElementsByClassName("geocoder-control-input");
for (index = 0; index < list.length; ++index) {
  list[index].setAttribute("placeholder", "Zoek een plaats...");
}
var results = new L.LayerGroup().addTo(sidenav);
searchControl.on("results", function(data) {
  if (marker) {
    map.removeLayer(marker);
  }
  loadkaart("normal");
  results.clearLayers();
  // for (var i = data.results.length - 1; i >= 0; i--) {
  results.addLayer((marker = new L.marker(data.results[i].latlng)));
  // }
  route(current_position, marker);
});

//schaal
L.control.scale().addTo(map);

//route
var LayerGroup10 = new L.layerGroup().addTo(map);
function route(latlng, latlng2) {
  routcheck = false;
  if (LayerGroup10) {
    // console.log(LayerGroup10);
    LayerGroup10.clearLayers();
  }
  document.getElementById("Btn6").style.display = "inline-block";
  document.getElementById("Btn5").style.display = "none";
  document.getElementById("Btn10").style.display = "inline-block";
  map.addLayer(marker);

  dir = MQ.routing.directions().on("success", function(data) {
    var legs = data.route.legs,
      html = "",
      maneuvers,
      i;

    if (legs && legs.length) {
      maneuvers = legs[0].maneuvers;

      for (i = 0; i < maneuvers.length; i++) {
        html += i + 1 + ". ";
        html += maneuvers[i].narrative + "";
        html += "<br>";
      }
      document.getElementById("Btn12").style.display = "none";
      document.getElementById("route-narrative").style.display = "inline-block";
      L.DomUtil.get("text_box").innerHTML = html;
    }
  });

  dir.route({
    locations: [
      { latLng: { lat: latlng._latlng.lat, lng: latlng._latlng.lng } },
      { latLng: { lat: latlng2._latlng.lat, lng: latlng2._latlng.lng } }
    ]
  });
  CustomRouteLayer = MQ.Routing.RouteLayer.extend({
    createStartMarker: function(location, stopNumber) {
      if (current_position) {
        map.removeLayer(current_position);
        map.removeLayer(circle);
      }
      //set location
      current_position = new L.circleMarker(
        [latlng._latlng.lat, latlng._latlng.lng],
        {
          color: "white",
          fillColor: "#4285f4",
          radius: 10,
          fillOpacity: 1
        }
      ).addTo(map);
      circle = new L.circleMarker([latlng._latlng.lat, latlng._latlng.lng], {
        color: "#d3e2f9",
        fillColor: "#d3e2f9",
        fillOpacity: 0.5,
        radius: 12
      }).addTo(map);
      map.addLayer(circle);
      map.addLayer(current_position);

      return current_position;
    },
    createEndMarker: function(location, stopNumber) {
      var custom_icon;
      var marker;
      custom_icon = L.icon({
        iconUrl:
          "https://www.mapquestapi.com/staticmap/geticon?uri=poi-red_1.png",
        iconSize: [20, 29],
        iconAnchor: [10, 29],
        popupAnchor: [0, -29]
      });
      marker = new L.marker(location.latLng, { icon: custom_icon }).addTo(map);
      return marker;
    }
  });

  routelayertest = new CustomRouteLayer({
    directions: dir,
    fitBounds: true
  }).addTo(LayerGroup10);
}

//stop route
function stopRoute() {
  if (document.getElementById("Btn10").classList.contains("active")) {
    document.getElementById("Btn10").classList.toggle("active");
    map.locate({
      watch: true,
      setView: false,
      maxZoom: 18,
      enableHighAccuracy: true
    });
  }

  if (LayerGroup10) {
    LayerGroup10.clearLayers();
  }
  document.getElementById("Btn6").style.display = "none";
  document.getElementById("Btn10").style.display = "none";
  document.getElementById("Btn12").style.display = "none";
  document.getElementById("route-narrative").style.display = "none";
  document.getElementById("Btn5").style.display = "inline-block";
}

$("#Btn10").click(function() {
  if (document.getElementById("Btn10").classList.contains("active")) {
    map.locate({
      watch: true,
      setView: false,
      maxZoom: 18,
      enableHighAccuracy: true
    });
  } else {
    map.locate({
      watch: true,
      setView: true,
      maxZoom: 18,
      enableHighAccuracy: true
    });
  }
  document.getElementById("Btn10").classList.toggle("active");
});
function hideRoute() {
  document.getElementById("route-narrative").style.display = "none";
  document.getElementById("Btn12").style.display = "block";
}
function showRoute() {
  document.getElementById("route-narrative").style.display = "block";
  document.getElementById("Btn12").style.display = "none";
}

//cursor on move
$("#map").mousedown(function() {
  $(this).css("cursor", "all-scroll");
});
$("#map").mouseup(function() {
  $(this).css("cursor", "auto");
});

function sidenavopen() {
  document.getElementById("sidenav").style.display = "none";
}

function sidenavclose() {
  document.getElementById("sidenav").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
  var elems = document.querySelectorAll(".sidenav");
  var instances = M.Sidenav.init(elems, {
    onCloseEnd: sidenavclose,
    onOpenStart: sidenavopen
  });
});