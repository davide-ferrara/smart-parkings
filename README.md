# Smart Parking RC

![image](example.png)

Smart Parking è una Web App che permette agli utenti di acquistare
biglietti per le soste a pagamento nella città di Reggio Calabria.
Il progetto è sviluppato principalmente in PHP, utilizzando il Framework
Laravel, che garantisce una struttura robusta e flessibile per il codice.
I vari parcheggi disponibili sono mostrati graficamente tramite la mappa
fornita da OpenStreetMap, resa interattiva grazie all’utilizzo della libreria
Leaflet.

# Run the app

### Clone the project

```bash
git clone https://github.com/davide-ferrara/smart-parkings.git
```

### Start all the containers and npm

```bash
cd smart-parkings
npm install
composer install
./start.sh
```

### Seed the database

```bash
docker exec <laravel-container-id> -it bash
php artisan db:seed
```

### Shut down the app

```bash
./vendor/bin/sail down
```
