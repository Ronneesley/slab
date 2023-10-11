@echo off

rem Entra dentro da pasta php e instala as dependências do npm e do composer
cd ..\php\src

rem NPM
echo ###########################################
echo Verificando se o NPM está instalado: 
call npm --version
if ERRORLEVEL 1 echo Instale o Node primeiro && exit
echo ###########################################

call npm install

rem COMPOSER
echo ###########################################
echo Verificando se o Composer está instalado: 
call composer --version 
if ERRORLEVEL 1 echo Instale o Composer primeiro && exit
echo ###########################################

call composer install

rem DOCKER
echo ###########################################
echo -n Verificando se o Docker está instalado: 
call docker --version 
if ERRORLEVEL 1 echo Instale o Docker primeiro && exit
echo ###########################################
