<!DOCTYPE html>
<html>

<head>
    <title>parkingMaps</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Must be AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script rel="text/javascript" src="{{ asset('js/classes/ParkingMap.js') }}"></script>
</head>

<body>
    <div id="parkingMapContainer" class="parkingMapContainer">
        <div id="parkingMap" class="ParkingMap"></div>
    </div>

        <input type="text" name="lat" id="lat" placeholder="Latitude">
        <input type="text" name="lng" id="lng" placeholder="Longitude">
        <button id="getFromMapBtn">Get from Map</button>
        <input type="text" name="lotNum" id="lotNum" placeholder="Parking Lot Number">

        <script rel="text/javascript" src="{{ asset('js/addParking.js') }}"></script>

</body>

</html>
