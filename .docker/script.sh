#!/bin/bash

set -e

APP_CONTAINER_ID=$(docker ps -aqf "name=app")

echo "[-] Setup environment variables [-]"
cp .env.example .env
printf "\n"

echo "[-] Setup Database [-]"
docker exec $APP_CONTAINER_ID php artisan migrate --seed --force
docker exec $APP_CONTAINER_ID composer install
printf "\n"

echo "[-] Change permissions [-]"
sudo chmod -R 777 storage bootstrap/cache
printf "\n"

echo "[-] Health Check APP [-]"
CURL_OUTPUT=$(docker exec $APP_CONTAINER_ID curl localhost:80/api \
                     --request GET \
                     --header "Content-Type: application/json" -s)

printf "\n"

if [[ $CURL_OUTPUT == '"API AppMax V1.0.0"' ]]
then
    echo "[+] Application ready. [+]"
else
    echo "[!] Setup Application error [!]"
fi