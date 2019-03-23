#!/bin/bash

echo "Waiting for db and applying migrations"
wait-for-it.sh db:3306 -t 300 -s -- yii migrate --interactive 0
echo "Starting web server"
exec apache2-foreground
