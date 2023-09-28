#!/bin/bash

source 'utilitarios.sh'

verificar_root

case $1 in
    node)
        sudo snap install node --classic
        verificar_operacao
        ;;
    composer)
        instalar_via_apt composer
        ;;
    docker)
        instalar_via_apt docker.io docker-compose
        ;;
    php)
        instalar_via_apt php apache2 libapache2-mod-php php-mysql php-gd php-xml
        ;;
    apache)
        instalar_via_apt apache2
        ;;
    configurar_php)
        if [ ! -d ~/www ]; then
            mkdir ~/www
        fi

        echo -n "Criando atalho para o diretório www do apache na sua pasta pessoal"
        sudo ln -s /var/www/html ~/www

        verificar_operacao

        echo -n "Dando permissão na pasta WWW..."
        sudo chmod -R 777 /var/www/html

        verificar_operacao
        ;;
    *)
        echo "Uso: sudo ./instalar_ferremanta.sh [FERRAMENTA]"
        echo
        echo "Argumentos para FERRAMENTA:"
        echo "node                  Gerenciador de dependências JavaScript"
        echo "composer              Gerenciador de dependências PHP"
        echo "docker                Ferramenta de virtualização de contêineres"
        echo "php                   Linguagem de Programação"
        echo "apache                Servidor Web"
        echo "configurar_php        Opção de configuração do PHP"
        echo
        echo "Exemplo:"
        echo "sudo ./instalar_ferremanta.sh php"
        ;;
esac