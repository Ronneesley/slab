# Jammy version
FROM ubuntu:22.04

WORKDIR /home

RUN apt update \
  && apt install -y \ 
  apache2 snapd

# Basear-me no documento da disciplina de ASOO sobre o Slab com a configuração para o ambiente dev

# Fazer um requirements file para instalar estes softwares:
#   apache2, php, Node, Composer, R, Twig, NPM, PDO, PDO Mysql, INTL, GD
#   NetBeans, MySQL Workbench

# Verificar e definir os WORKDIR deste Dockerfile
# Inserir os RUN nos WORKDIR corretos

RUN composer install
RUN npm install