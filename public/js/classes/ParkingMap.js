/*  Parking map Class
    Leatlet Docs: https://leafletjs.com/reference.html
*/

class ParkingMap {
    constructor(mapContainerId, lat, lng, initialZoom) {
        this.mapContainerId = mapContainerId;
        this.lat = lat;
        this.lng = lng;
        this.initialZoom = initialZoom;
        this.maxZoom = 19; // Cambiato da maxinitialZoom a maxZoom
        this.lMap = L.map(this.mapContainerId).setView(
            [this.lat, this.lng],
            this.initialZoom
        ); // Imposta la posizione e il livello di zoom iniziale
        this.parkingsList = []; // Lista di tutti i parcheggi, es: {lotNumber: x, parking: parkingObj}
    }

    draw() {
        // Aggiungi un layer di mappa (OpenStreetMap)
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: this.maxZoom, // Cambiato da maxinitialZoom a maxZoom
            attribution: "© OpenStreetMap",
        }).addTo(this.lMap);
    }

    addParking(lat, lng, status, data, lotNumber) {
        // Aggiunge un cerchio nella mappa
        var newParking = L.circle([lat, lng], {
            color: Number(status) ? "green" : "red",
            fillOpacity: 0.5,
            radius: 0.1,
        }).addTo(this.lMap);

        newParking.bindPopup(data);
        this.parkingsList.push({ lotNumber: lotNumber, parking: newParking });
    }

    removeParking(lotNumber) {
        // Trova l'indice del parcheggio con il numero di lotto specificato
        const parkingIdx = this.findParkingIdx(lotNumber);

        if (parkingIdx === -1) {
            console.log(`Parcheggio con lotto ${lotNumber} non trovato`);
            return; // Esci dalla funzione se non trovato
        }

        this.lMap.removeLayer(this.parkingsList[parkingIdx].parking); // Rimuovi l'oggetto parcheggio dalla mappa
        this.parkingsList.splice(parkingIdx, 1);
        console.log(`Parcheggio con lotto ${lotNumber} rimosso.`);
    }

    changeParkingStatus(parkingObj) {
        var currColor = String(parkingObj.options.color);

        if (currColor === "red") {
            parkingObj.setStyle({ color: "green" });
        } else {
            parkingObj.setStyle({ color: "red" });
        }
    }

    findParkingIdx(lotNumber) {
        // Trova l'indice del parcheggio con il numero di lotto specificato
        return this.parkingsList.findIndex(
            (parking) => parking.lotNumber === lotNumber
        );
    }

    getParkingsList() {
        return this.parkingsList;
    }
}
