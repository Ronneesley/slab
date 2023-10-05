# Jammy version
FROM ubuntu:22.04

WORKDIR /home

RUN apt update \
  && apt install -y \ 
  apache2 snapd

# Fazer um requirements file para instalar estes softwares:
#   apache2, php, Node, Composer, R, Twig, NPM, PDO, PDO Mysql, INTL, GD

# Verificar e definir os WORKDIR deste Dockerfile
# Inserir os RUN nos WORKDIR corretos

RUN composer install
RUN npm install