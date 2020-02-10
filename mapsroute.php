<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Leaflet</title>
    <!-- materialize-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- cdn leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <!-- osm -->
    <script src="https://cdn.osmbuildings.org/classic/0.2.2b/OSMBuildings-Leaflet.js"></script>  
    <script src="//cdn.jsdelivr.net/leaflet.esri/2.0.0-beta.7/esri-leaflet.js"></script>
    <!-- route -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=AabzipTGobBGH6xSsK1Vb6PD40W58ep3"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=AabzipTGobBGH6xSsK1Vb6PD40W58ep3"></script>
    <!-- zoekfunctie -->
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
    <!-- <link rel="stylesheet" type="text/css" href="stylesearch.css"> -->

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- own css -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="button_box_route leaflet-right leaflet-top">
    <button type="button" id="Btn12" value="Show" onclick="showRoute()" class="btnStyle span3 leaflet-control Button"><i class="material-icons">arrow_drop_down</i></button>
</div>
<div id="route-narrative" class="Route">
    <div class="button_box_route">
        <button type="button" id="Btn11" value="Hide" onclick="hideRoute()" class="btnStyle span3 leaflet-control Button"><i class="material-icons">close</i></button>
    </div>
    <div id="text_box"></div>
</div>

<div class="span9" style="height:100%">
    <div id="map">
        <div class="leaflet-bottom leaflet-right button_box" style="display:inline-block;">
            <button type="button" id="Btn1" value="Osm" onclick="loadkaart('osm')" class="btnStyle span3 leaflet-control Button"><i class="material-icons">3d_rotation</i></button>
            <button type="button" id="Btn2" value="Satellite" onclick="loadkaart('satellite')" class="btnStyle span3 leaflet-control Button" ><i class="material-icons">satellite</i></button> 
            <button type="button" id="Btn3" value="Kaart" onclick="loadkaart('normal')" class="btnStyle span3 leaflet-control Button" ><i class="material-icons">map</i></button>
            <button type="button" id="Btn5" value="route" onclick="route(current_position,marker)" class="btnStyle span3 leaflet-control Button" ><i class="material-icons">directions</i></button>
            <button type="button" id="Btn6" value="" onclick="stopRoute()" class="btnStyle span3 leaflet-control Button"><i class='material-icons'>stop</i></button>
        </div>
        <div class="leaflet-bottom leaflet-right button_box2">
            <button type="button" id="Btn10" value="" class="btnStyle span3 leaflet-control Button"><i class='material-icons'>drive_eta</i></button>
            <button type="button" id="Btn4" value="" onclick="setview(current_position)" class="btnStyle span3 leaflet-control Button"> <i class='material-icons'>my_location</i></button>
        </div>
    </div>
</div>

<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <p>HOI</p>
        </div>
    </li>
</ul>

<div class="leaflet-top leaflet-left">
    <br><br><br>
    <a href="#" data-target="slide-out" class="leaflet-control sidenav-trigger" style="cursor: pointer;"><i class="material-icons">menu</i></a>
</div>

</body>
<!-- own js -->
<script src="script.js"></script>
</html>

