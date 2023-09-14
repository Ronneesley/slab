#!/bin/bash

source 'utilitarios.sh'

verificar_root

case $1 in
    netbeans)
        sudo snap install netbeans --classic
        verificar_operacao
        ;;
    mysql_workbench)
        echo -n "Instalando o Workbench..."
        sudo snap install mysql-workbench-community
        verificar_operacao

        echo -n "Configurando armazenamento das senhas..."
        sudo snap connect mysql-workbench-community:password-manager-service :password-manager-service
        verificar_operacao
        ;;
    *)
        echo "Uso: sudo ./instalar_ferramentas_dev.sh [FERRAMENTA]"
        echo
        echo "Argumentos para FERRAMENTA:"
        echo "netbeans              IDE para codificação Java e PHP"
        echo "mysql_workbench       Ambiente de diagramação e interação com o MySQL"
        echo
        echo "Exemplo:"
        echo "sudo ./instalar_ferramentas_dev.sh netbeans"
        ;;
esac