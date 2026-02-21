#!/bin/bash

# Installation des dépendances si le dossier vendor n'existe pas
if [ ! -d "vendor" ]; then
    composer install --no-interaction --optimize-autoloader
fi

# Copie du .env si absent
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

php artisan key:generate --force
php artisan migrate:fresh --seed --force

# Installation et build des assets JS/CSS
if [ ! -d "node_modules" ]; then
    npm install
fi
npm run build

# On lance Apache en arrière-plan (commande par défaut de l'image)
exec apache2-foreground
