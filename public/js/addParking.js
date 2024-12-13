// addParking.js

lat = 38.0743889;
long = 15.65425;
zoom = 15;
lotNumber = 0;

// Crea un'istanza della classe parkingMap
var parkingMap = new ParkingMap("parkingMap", lat, long, zoom);

// Disegna la parkingMappa
parkingMap.draw();

let parkingSpots = [
    { lat: 38.07466701069013, long: 15.65378469677512 },
    { lat: 38.07464695185806, long: 15.653798778372094 },
    { lat: 38.0746300602057, long: 15.65381084831236 },
    { lat: 38.07461211282083, long: 15.653825600461571 },
    { lat: 38.074588358922284, long: 15.653843705371973 },
    { lat: 38.07455510345138, long: 15.653867174700265 },
];

parkingSpots.forEach((parking) => {
    data = `Lat: ${parking["lat"]}, Long: ${parking["long"]} Numero lotto: ${lotNumber}`;
    //status = Math.floor(Math.random() * 2);
    status = 0;

    parkingMap.addParking(
        parking["lat"],
        parking["long"],
        status,
        data,
        lotNumber
    );
    ++lotNumber;
});

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

//console.log(parkingMap.getParkingsList());
//parkingMap.removeParking(parkingList[5].lotNumber);
//parkingMap.changeParkingStatus(parkingList[4].parking);
