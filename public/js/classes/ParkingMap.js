/*  Parking map Class
    Leatlet Docs: https://leafletjs.com/reference.html
*/

class ParkingMap {
    constructor(mapContainerId, lat, lng, initialZoom, zones) {
        this.mapContainerId = mapContainerId;
        this.lat = lat;
        this.lng = lng;
        this.initialZoom = initialZoom;
        this.maxZoom = 21;
        this.lMap = L.map(this.mapContainerId).setView(
            [this.lat, this.lng],
            this.initialZoom
        ); // Imposta la posizione e il livello di zoom iniziale
        this.zones = zones;
        this.polygons = [];
        this.parkingsList = []; // Lista di tutti i parcheggi, es: {lotNumber: x, parking: parkingObj}
        this.refreshRate = 1000 * 10; //1000ms = 1s
    }

    draw() {
        // Aggiungi un layer di mappa (OpenStreetMap)
        // L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        //     maxZoom: this.maxZoom, // Cambiato da maxinitialZoom a maxZoom
        //     attribution: "© OpenStreetMap",
        // }).addTo(this.lMap);

        L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
            maxZoom: this.maxZoom,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        }).addTo(this.lMap);

        this.drawZones();
        const updateParkingLots = () => {
            console.log('[Parking Map] Starting Updating...');

            if (this.parkingsList.length > 0) this.removeAllParkings();

            this.getParkingLots()
                .then(parkingLots => {
                    // console.log(parkingLots);

                    parkingLots.forEach(parking => {

                        if (parking.curr_status === 1) {
                            var form = `
                            <div class="flex flex-col space-y-4">
                                <label class="text-lg font-semibold text-center">Lot Number: ${parking.lot_number}</label>
                                <label class="text-sm text-gray-600">Occuped by: ${parking.license_plate}</label>
                            </div>
                        `;
                        } else {
                            var form = `
                            <form action="/parking/${parking.lot_number}" method="GET" class="flex flex-col space-y-4">
                                <label htmlFor="LotNumber" class="text-lg font-semibold text-center">Lot Number: ${parking.lot_number}</label>
                                <button id="${parking.lot_number}" type="submit" class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">Park here</button>
                            </form>
                        `;
                        }

                        parkingMap.addParking(
                            parking.lat,
                            parking.lng,
                            parking.curr_status,
                            form,
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

    drawZones() {
        this.zones.forEach(zone => {
            const polygon = L.polygon(zone.coords, {
                color: zone.color,
                fillColor: zone.fillColor,
                fillOpacity: 0.2
            }).addTo(this.lMap).bindPopup(`Zone: ${zone.zone}, Price: ${zone.price}`);
            this.polygons.push(polygon);
        });

    }

    addParking(lat, lng, status, data, lotNumber) {
        // Aggiunge un cerchio nella mappa
        var newParking = L.circle([lat, lng], {
            color: Number(status) ? "red" : "#167cb9",
            fillOpacity: 0.5,
            radius: 2,
        }).addTo(this.lMap);

        newParking.bindPopup(data);
        this.parkingsList.push({
            newParking
        });
    }

    getParkingLots() {
        return new Promise((resolve, reject) => {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "/api/parking-lots", true);
            xhttp.send();

            xhttp.onreadystatechange = function () {
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
