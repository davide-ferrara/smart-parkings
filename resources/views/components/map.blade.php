<div class="flex-1 w-full h-full box-border overflow-hidden" id="mapContainer">
    <div id="parkingMap"></div>
</div>


<script>
    let lat = 38.0743889;
    let long = 15.65425;
    let InitialZoom = 19;
    let lotNumber = 0;

    let parkingMap = new ParkingMap("parkingMap", lat, long, InitialZoom);
    parkingMap.draw();
</script>
