#!/bin/bash

echo ""
echo "Starting installation"
echo ""

echo ""
echo "=================================================> 0%"
echo ""

echo ""
echo "1) Up the containers"
echo ""

docker-compose -p kafka_playground up -d

echo ""
echo "=================================================> 50%"
echo ""

echo ""
echo "2) Start supervisor"
echo ""

docker exec customer_api_application supervisorctl reread

docker exec customer_api_application supervisorctl update

docker exec customer_api_application supervisorctl start address-api-new-address:*

echo ""
echo "=================================================> 100%"
echo ""

sh ../address-api/docker/installer.sh

sh ../customer-api/docker/installer.sh

echo ""
echo "Installation completed"
echo ""
