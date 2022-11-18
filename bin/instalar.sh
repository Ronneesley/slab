#!/bin/bash

./instalacao_php.sh
./instalacao_netbeans.sh
./instalacao_mysql_workbench.sh
./instalacao_composer.sh

cd ../php/src
composer install
npm install
