#!/bin/bash

# Aggiorna i repository
apt-get update

# Installa cron
apt-get install -y cron

# Avvia il servizio cron
service cron start
