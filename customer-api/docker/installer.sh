#!/bin/bash

echo ""
echo "Starting installation Customer Api"
echo ""

echo ""
echo "=================================================> 0%"
echo ""

echo ""
echo "1) Creating file .env"
echo ""

docker exec customer_api_application cp .env.example .env

echo ""
echo "=================================================> 20%"
echo ""

echo ""
echo "2) Installing dependencies by composer"
echo ""

docker exec customer_api_application composer install

echo ""
echo "=================================================> 40%"
echo ""

echo ""
echo "3) Set the application key"
echo ""

docker exec customer_api_application php artisan key:generate

echo ""
echo "=================================================> 60%"
echo ""

echo ""
echo "4) Running migrations"
echo ""

docker exec customer_api_application php artisan migrate

echo ""
echo "=================================================> 80%"
echo ""

echo ""
echo "5) Running unit tests"
echo ""

docker exec customer_api_application vendor/bin/phpunit tests/Unit/ --testdox

echo ""
echo "=================================================> 100%"
echo ""

echo ""
echo "Installation Customer Api completed"
echo ""
