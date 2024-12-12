# Smart Parking RC

TODO:

1. Pannello admin dov'è possibile aggiungere parcheggi tramite mappa nel DB
2. Registrazione utente
3. Login utente

Smart Parking RC è un applicazione Web che permette di acquista biglietti per le soste a pagamento a Reggio Calabria.
E' principalemente scritta in php utilizzando il framework Laravel.
L'utente dopo essersi registrato potrà acquistare tramite moneta del credito che andrà ad utilizzare per pagare la sosta nei parcheggi.
IL costo della sosta è si 1.00 €/h.
Per ogni sosta l'utente dovrà indicare il parcheggio nel qualche si trova o utilizzare la mappa interattiva cliccando su di esso.
L'utente potrà visualizzare tutti i parcheggi occupati(colore rosso) e non occupati(colore verde) all'interno della mappa.

Certo! Ecco le stesse informazioni in italiano:

### Suggerimenti per Migliorare la Descrizione del Progetto

1. **Esperienza Utente**:

    - Menziona come gli utenti possono registrarsi e accedere facilmente all'applicazione.
    - Sottolinea eventuali funzionalità che migliorano l'esperienza utente, come notifiche per la scadenza del parcheggio o promemoria per rinnovare il parcheggio.

2. **Mappa Interattiva**:

    - Elabora sulla funzionalità della mappa interattiva. Ad esempio, potresti menzionare se gli utenti possono filtrare i posti auto in base alla disponibilità, alla zona o ad altri criteri.

3. **Metodi di Pagamento**:

    - Specifica i metodi di pagamento disponibili per l'acquisto di crediti (ad esempio, carta di credito, PayPal, ecc.).

4. **Compatibilità Mobile**:

    - Se applicabile, menziona se l'applicazione è compatibile con i dispositivi mobili o se esiste una versione mobile dell'app.

5. **Funzionalità Amministrative**:

    - Se ci sono funzionalità amministrative (ad esempio, gestione dei posti auto, visualizzazione delle transazioni, ecc.), includi queste informazioni.

6. **Funzionalità di Sicurezza**:

    - Accenna brevemente a eventuali misure di sicurezza in atto per proteggere i dati degli utenti e le transazioni.

7. **Miglioramenti Futuri**:
    - Considera di menzionare potenziali funzionalità future, come integrazioni con app di navigazione o aggiornamenti in tempo reale sulla disponibilità dei parcheggi.

#### Tabella Users

```plaintext
Users:
    id PK,
    name,
    surname,
    username UNIQUE,
    email UNIQUE,
    email_verified_at TIMESTAMP,
    phone_number UNIQUE,
    phone_number_verified_at TIMESTAMP,
    gender,
    date_of_birth DATE,
    password,
    remember_token,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
```

#### Tabella Vehicles

```plaintext
Vehicles:
    id PK,
    user_id FK REFERENCES Users(id),
    plate_number UNIQUE,
    vehicle_name,
    registered_at DATE
```

#### Tabella Credits

```plaintext
Credits:
    id PK,
    user_id FK REFERENCES Users(id),
    total_credit DECIMAL(10, 2) DEFAULT 0.00
```

#### Tabella Parking Sessions

```plaintext
Parking_Sessions:
    id PK,
    vehicle_plate_number FK REFERENCES Vehicles(plate_number),
    parked_at TIMESTAMP,
    total_time_in_minutes INT,
    street_address VARCHAR(255)
```

#### Tabella Parking Spots

```plaintext
Parking_Spots:
    id PK,
    lat DECIMAL(9, 6),
    long DECIMAL(9, 6),
    lot_number UNIQUE,
    zone VARCHAR(50),
    status 0|1,
    registered_at TIMESTAMP,
    street_address VARCHAR(255)
```

#### Tabella Transactions

```plaintext
Transactions:
    id PK,
    user_id FK REFERENCES Users(id),
    parked_vehicle_plate_number FK REFERENCES Parking_Sessions(vehicle_plate_number),
    transaction_date TIMESTAMP,
    total_cost DECIMAL(10, 2)
```

#### Tabella Notifications

```plaintext
Notifications:

```
