<head> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js" integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg==" crossorigin=""></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.9.2/leaflet-geocoder-mapzen.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.9.2/leaflet-geocoder-mapzen.js"></script>
</head>
<body>
    <div id='mapid' style='width: 400px; height: 300px;'></div>
    <script>
        var mymap = L.map('mapid').setView([48.85661, 2.3515], 11);
        L.tileLayer('https://tile.jawg.io/jawg-dark/{z}/{x}/{y}.png?access-token=zdrHAN0pl1HR1f7pN6EFPYYMgBGDj8Oxwuv6LJx1GKgnXOS4DLmNeaCkjFOhrPEc', {}).addTo(mymap);
        mymap.attributionControl.addAttribution("<a href=\"https://www.jawg.io\" target=\"_blank\">&copy; Jawg</a> - <a href=\"https://www.openstreetmap.org\" target=\"_blank\">&copy; OpenStreetMap</a>&nbsp;contributors")
        L.control.geocoder('zdrHAN0pl1HR1f7pN6EFPYYMgBGDj8Oxwuv6LJx1GKgnXOS4DLmNeaCkjFOhrPEc', {url: 'https://api.jawg.io/places/v1', autocomplete: false}).addTo(mymap);
    </script>
</body>