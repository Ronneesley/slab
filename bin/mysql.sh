#!/bin/bash

source 'utilitarios.sh'

verificar_root

#Obtém o diretório corrente
DIR=`pwd`

#Entra no diretório do Dockerfile MySQL
cd ../mysql

#Verifica qual ação a pessoa quer fazer
case $1 in
    rodar)
        docker run -p 13306:3306 --name slab-mysql_1 --rm -i -t slab-mysql
        ;;
    compilar)
        docker build -t slab-mysql .
        ;;
    logar)
        docker exec -it slab-mysql_1 bash        
        ;;
    parar)
        docker stop slab-mysql_1
        ;;
    remover)
        docker rm slab-mysql_1
        ;;
    remover_imagem)
        docker rmi slab-mysql -f
        ;;
    *)
        echo "Uso: sudo ./mysql.sh [ACAO]"
        echo 
        echo "Argumentos"
        echo "compilar              Compila o Dockerfile do container"
        echo "rodar                 Executa o container"
        echo "logar                 Entra no container caso esteja rodando"
        echo "parar                 Para o container"
        echo "remover               Remove o container"
        echo "remover_imagem        Remove a imagem do container"
        echo 
        echo "Exemplo: "
        echo "sudo ./mysql.sh compilar"
        ;;
esac

#Volta ao diretório original
cd $DIR