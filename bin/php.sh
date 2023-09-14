#!/bin/bash

source 'utilitarios.sh'

verificar_root

#Obtém o diretório corrente
DIR=`pwd`

#Entra no diretório do Dockerfile MySQL
cd ../php

#Verifica qual ação a pessoa quer fazer
case $1 in
    rodar)
        docker run -p 3000:80 --name slab-php_1 --rm -i -t slab-php
        ;;
    compilar)
        #Verifica qual ambiente está sendo trabalhado
        case $2 in
            "--dev")
                DOCKERFILE=Dockerfile-dev
                ;;
            "--prod")
                DOCKERFILE=Dockerfile-prod
                ;;
            *)
                echo "Especifica o ambiente de implantação: --dev ou --prod"
                exit;
                ;;
        esac

        docker build -t slab-php . -f $DOCKERFILE
        ;;
    logar)
        docker exec -it slab-php_1 bash        
        ;;
    parar)
        docker stop slab-php_1
        ;;
    remover)
        docker rm slab-php_1
        ;;
    remover_imagem)
        docker rmi slab-php -f
        ;;
    *)
        echo "Uso: sudo ./php.sh [ACAO]"
        echo 
        echo "Argumentos para ACAO"
        echo "compilar      [ENV]       Compila o Dockerfile do container"
        echo "rodar                     Executa o container"
        echo "logar                     Entra no container caso esteja rodando"
        echo "parar                     Para o container"
        echo "remover                   Remove o container"
        echo "remover_imagem            Remove a imagem do container"
        echo
        echo "Argumentos para ENV"
        echo "--dev         Ambiente de desenvolvimento"
        echo "--prod        Ambiente de produção"
        echo 
        echo "Exemplo: "
        echo "sudo ./php.sh compilar"
        ;;
esac

#Volta ao diretório original
cd $DIR