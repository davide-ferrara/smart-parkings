/*  Parking map Class
    Leatlet Docs: https://leafletjs.com/reference.html
*/

class ParkingMap {
    constructor(mapContainerId, lat, lng, initialZoom) {
        this.mapContainerId = mapContainerId;
        this.lat = lat;
        this.lng = lng;
        this.initialZoom = initialZoom;
        this.maxZoom = 21;
        this.lMap = L.map(this.mapContainerId).setView(
            [this.lat, this.lng],
            this.initialZoom
        ); // Imposta la posizione e il livello di zoom iniziale
        this.parkingsList = []; // Lista di tutti i parcheggi, es: {lotNumber: x, parking: parkingObj}
        this.refreshRate = 1000 * 10; //1000ms = 1s
    }

    draw() {
        // Aggiungi un layer di mappa (OpenStreetMap)
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: this.maxZoom, // Cambiato da maxinitialZoom a maxZoom
            attribution: "© OpenStreetMap",
        }).addTo(this.lMap);

        const updateParkingLots = () => {
            console.log('[Parking Map] Starting Updating...');

            if(this.parkingsList.length > 0) this.removeAllParkings();

            this.getParkingLots()
                .then(parkingLots => {
                    // console.log(parkingLots);

                    parkingLots.forEach(parking => {
                        var button = `<button id="${parking.id}" class="button">Park here</button>`;
                        //var data = `<h1> Lat: ${parking.lat}, Long: ${parking.lng} Numero lotto: ${parking.lot_number} <\h1>`;
                        var description = `<h4> Status: todo <br> Lot Number: ${parking.lot_number} <\h4>`;
                        var data = description + button;

                        parkingMap.addParking(
                            parking.lat,
                            parking.lng,
                            parking.curr_status,
                            data,
                            parking.lot_number
                        );
                    })
                })
                .catch(error => {
                    console.log(error);
                })
            console.log('[Parking Map] Parking lots updated!');
        };

        updateParkingLots();
        setInterval(updateParkingLots, this.refreshRate); // 1000 millisecondi = 1 secondo
    }

    addParking(lat, lng, status, data, lotNumber) {
        // Aggiunge un cerchio nella mappa
        var newParking = L.circle([lat, lng], {
            color: Number(status) ? "red" : "#167cb9",
            fillOpacity: 0.5,
            radius: 1,
        }).addTo(this.lMap);

        newParking.bindPopup(data);
        this.parkingsList.push({newParking });
    }

    getParkingLots() {
        return new Promise((resolve, reject) => {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "/api/parking-lots", true);
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
        });
    }

    removeAllParkings() {
        console.log('[Parking Map] Cleared all parkings!');
        this.parkingsList.forEach(parkingLot => {
            this.lMap.removeLayer(parkingLot.newParking);
        })
        this.parkingsList = [];
    }

}
