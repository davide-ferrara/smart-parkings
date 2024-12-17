// addParking.js

/*let lat = 38.0743889;
let long = 15.65425;
let zoom = 15;
let lotNumber = 0;

let parkingMap = new ParkingMap("parkingMap", lat, long, zoom);
parkingMap.draw();
*/

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

    parkingMap.lMap.off("click", parkingMap.onMapClick, parkingMap);

    parkingMap.lMap.on("click", (e) => {
        //console.log(`Lat: ${e.latlng.lat}, Long: ${e.latlng.lng}`);
        parkingMap.lMap.off("click");
        mapContainer.style.border = "0px";
        parkingMap.lMap.getContainer().style.cursor = "grab";

        document.getElementById("Latitude").value = e.latlng.lat;
        document.getElementById("Longitude").value = e.latlng.lng;

        getParkingdata(e.latlng.lat, e.latlng.lng).then(
            data => {
                var address = data.display_name
                document.getElementById("Address").value = address
                console.log(data);
            }
        ).catch(error => {
            console.log(error);
        })

    });

});
