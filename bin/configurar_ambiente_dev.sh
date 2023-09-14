#!/bin/bash

#Entra dentro da pasta php e instala as dependências do npm e do composer
cd ../php/src
npm install
composer install

#Cria e dá permissão no diretório temporário
mkdir tmp
chmod -R 777 tmp

#Dá permissão no arquivo de configuração do banco de dados
chmod 777 configuracoes.json
