#!/bin/bash
set -e

# Run Laravel migrations and seed the database
php artisan migrate --force
php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000