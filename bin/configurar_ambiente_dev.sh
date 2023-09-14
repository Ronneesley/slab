#!/bin/bash

source 'utilitarios.sh'

#Entra dentro da pasta php e instala as dependências do npm e do composer
cd ../php/src

npm install
verificar_operacao

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