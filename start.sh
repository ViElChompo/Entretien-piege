#!/bin/bash

# Lancer Laravel backend
cd entretien-piege-backend
php artisan serve &
cd ..

# Lancer Vue frontend
cd entretien-piege-frontend
npm run dev
