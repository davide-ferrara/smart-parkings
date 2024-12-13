// addParking.js

let lat = 38.0743889;
let long = 15.65425;
let zoom = 15;
let lotNumber = 0;

let parkingMap = new ParkingMap("parkingMap", lat, long, zoom);
parkingMap.draw();

const getFromMapBtn = document.getElementById("getFromMapBtn");

getFromMapBtn.addEventListener("click", () => {
    const parkingMapContainer = document.getElementById("parkingMapContainer");
    parkingMap.lMap.getContainer().style.cursor = "crosshair";
    parkingMapContainer.style.border = "3px solid red";

    parkingMap.lMap.off("click", parkingMap.onMapClick, parkingMap);

    parkingMap.lMap.on("click", (e) => {
        //console.log(`Lat: ${e.latlng.lat}, Long: ${e.latlng.lng}`);
        parkingMap.lMap.off("click");
        parkingMapContainer.style.border = "0px";
        parkingMap.lMap.getContainer().style.cursor = "grab";

        document.getElementById("flat").value = e.latlng.lat;
        document.getElementById("flng").value = e.latlng.lng;
    });
});
