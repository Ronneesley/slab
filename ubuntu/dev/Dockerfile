# Jammy version
FROM ubuntu:22.04

WORKDIR /

#ENV DEBIAN_FRONTEND noninteractive

# Exporta o fuso horário para não pedir área geográfica durante as instalações
ENV TZ=America/Sao_Paulo

# Aloca o dado do fuso horário em /etc/timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt update && \
    apt install -y apache2 php libapache2-mod-php && \
    apt clean

WORKDIR /var/www

RUN chmod -r 777 ./html

WORKDIR /var/www/html

RUN rm -f index.html

# Visualizar erros de código no PHP (SETAR PARA "ON")
COPY php.ini /etc/php/8.1/apache2/php.ini

RUN /etc/init.d/apache2 restart

RUN apt install -y composer
RUN apt install -y r-base
RUN apt install -y nodejs
RUN apt install -y npm \
    && apt clean

RUN composer install
RUN npm install

RUN apt install -y php-twig
RUN apt install -y php-intl
RUN apt install -y php-gd
RUN apt install -y php-pdo
RUN apt install -y php-pdo-mysql \
    && apt clean

RUN apt install -y mysql-server mysql-client \
    && apt clean

RUN apt install snapd && apt clean
RUN snap install -y node --classic
RUN snap install mysql-workbench-community
RUN snap install netbeans --classic