#!/bin/bash

echo -n "Instalando o PHP e o Apache2..."
sudo apt install -y php apache2 libapache2-mod-php php-mysql php-gd

if [ $? -eq 0 ]; then 
	echo "OK"
else
	echo "ERRO"
fi

if [ -d ~/www ]; then
	mkdir ~/www
fi

echo -n "Criando atalho para o diretório www do apache na sua pasta pessoal"
sudo ln -s /var/www/html ~/www

if [ $? -eq 0 ]; then 
	echo "OK"
else
	echo "ERRO"
fi
