<div id="parkingMapContainer" class="parkingMapContainer">
    <div id="parkingMap" class="ParkingMap"></div>
</div>

<script>
    let lat = 38.0743889;
    let long = 15.65425;
    let zoom = 15;
    let lotNumber = 0;

    let parkingMap = new ParkingMap("parkingMap", lat, long, zoom);
    parkingMap.draw();

    const getFromMapBtn = document.getElementById("getFromMapBtn");
</script>
