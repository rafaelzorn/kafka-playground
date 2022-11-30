#!/bin/bash

echo ""
echo "Starting installation Address Api"
echo ""

echo ""
echo "=================================================> 0%"
echo ""

echo ""
echo "1) Creating file .env"
echo ""

docker exec address_api_application cp .env.example .env

echo ""
echo "=================================================> 25%"
echo ""

echo ""
echo "2) Installing dependencies by composer"
echo ""

docker exec address_api_application composer install

echo ""
echo "=================================================> 50%"
echo ""

echo ""
echo "3) Set the application key"
echo ""

docker exec address_api_application php artisan key:generate

echo ""
echo "=================================================> 75%"
echo ""

echo ""
echo "4) Running integration tests"
echo ""

docker exec address_api_application vendor/bin/phpunit tests/Integration/ --testdox

echo ""
echo "=================================================> 100%"
echo ""

echo ""
echo "Installation Address Api completed"
echo ""
