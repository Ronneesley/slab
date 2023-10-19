#!/bin/bash

source 'utilitarios.sh'

case $1 in
    abrir)
        google-chrome http://localhost:3000/
        ;;
    dev)
        verificar_root
        echo "Iniciando ambiente de desenvolvimento..."
        docker-compose -f ../docker-compose-dev.yaml up
        ;;
    prod)
        verificar_root
        echo "Iniciando ambiente de produção..."
        docker-compose -f ../docker-compose-prod.yaml up
        ;;
    ubuntu-dev)
        verificar_root
        echo "Iniciando ambiente de desenvolvimento..."
        docker-compose -f ../docker-compose-ubuntu-dev.yaml up
        ;;
    ubuntu-prod)
        verificar_root
        echo "Iniciando ambiente de produção..."
        docker-compose -f ../docker-compose-ubuntu-prod.yaml up
        ;;
    remover_imagens)
        verificar_root
        docker rmi slab_php slab_mysql -f
        ;;
    testes)
        cd ../php/src/
        ./vendor/bin/phpunit tests
        ;;
    *)
        echo "Uso: ./slab.sh [ACAO]"
        echo
        echo "Argumentos para ACAO"
        echo "abrir                         Abre o navegador no SLab"
        echo "dev                           Sobe os containers para desenvolvimento do SLab"
        echo "prod                          Sobe os containers para ambiente de produção do SLab"
        echo "ubuntu-dev                    Sobe os containers para desenvolvimento do SLab usando o container do Ubuntu"
        echo "ubuntu-prod                   Sobe os containers para ambiente de produção do SLab usando o container do Ubuntu"
        echo "remover_imagens               Remove as imagens do ambiente atual"
        echo "testes                        Executa os testes unitários do PHP"
        echo
        echo "Exemplo: sudo ./slab.sh dev"
        ;;
esac

