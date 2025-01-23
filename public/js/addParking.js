// addParking.js
function getParkingdata(lat, lng) {
    return new Promise(function(resolve, reject) {
        var url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;
        console.log(url);
        var xhttp = new XMLHttpRequest();

        xhttp.open("GET", url, true);
        xhttp.send();

        xhttp.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject(new Error("Request failed with status: " + this.status));
                }
            }
        };
    })
}

const getFromMapBtn = document.getElementById("getFromMapBtn");

getFromMapBtn.addEventListener("click", () => {
    console.log("Pick a point in the map!");

    const mapContainer = document.getElementById("mapContainer");
    parkingMap.lMap.getContainer().style.cursor = "crosshair";
    mapContainer.style.border = "3px solid red";

    // Rimuovi i poligoni dalla mappa
    parkingMap.polygons.forEach(polygon => {
        polygon.remove();
    });

    // Disattiva i precedenti listener
    parkingMap.lMap.off("click", parkingMap.onMapClick, parkingMap);

    console.log(parkingMap.lMap);

    // Aggiungi un listener per il clic sulla mappa
    parkingMap.lMap.on("click", (e) => {
        parkingMap.lMap.off("click"); // Rimuove l'ascoltatore per evitare conflitti
        mapContainer.style.border = "0px";
        parkingMap.lMap.getContainer().style.cursor = "grab";

        // Inserisce i valori di latitudine e longitudine
        document.getElementById("Latitude").value = e.latlng.lat;
        document.getElementById("Longitude").value = e.latlng.lng;

        // Esegui la chiamata API
        getParkingdata(e.latlng.lat, e.latlng.lng)
            .then(data => {
                document.getElementById("Address").value = data.display_name;
                console.log(data);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                // Riaggiungi i poligoni alla mappa
                parkingMap.polygons.forEach(polygon => {
                    polygon.addTo(parkingMap.lMap);
                });
            });
    });
});

