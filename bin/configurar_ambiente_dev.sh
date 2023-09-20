#!/bin/bash

source 'utilitarios.sh'

#Entra dentro da pasta php e instala as dependências do npm e do composer
cd ../php/src

#NPM
echo "###########################################"
echo -n "Verificando se o NPM está instalado: "
npm --version
echo "###########################################"

if [ $? -ne 0 ]; then
    echo "Iniciando a instalação do NPM primeiro: "
    sudo ./instalar_ferramenta.sh node
fi

npm install
verificar_operacao

#COMPOSER
echo "###########################################"
echo -n "Verificando se o Composer está instalado: "
composer --version
echo "###########################################"

if [ $? -ne 0 ]; then
    echo "Iniciando a instalação do Composer primeiro: "
    sudo ./instalar_ferramenta.sh composer
fi

composer install
verificar_operacao

#Cria e dá permissão no diretório temporário
if [ ! -d tmp ]; then
    mkdir tmp
fi
chmod -R 777 tmp
rm -rf tmp/*        #Limpa possíveis arquivos sem permissão

#Dá permissão no arquivo de configuração do banco de dados
chmod 777 configuracoes.json

#DOCKER
echo "###########################################"
echo -n "Verificando se o Docker está instalado: "
docker --version
echo "###########################################"

if [ $? -ne 0 ]; then
    echo "Iniciando a instalação do Docker primeiro: "
    sudo ./instalar_ferramenta.sh docker
fi