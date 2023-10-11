@echo off

set ACAO=%1

2>NUL CALL :%ACAO%
if ERRORLEVEL 1 CALL :default

exit /B

:dev
    echo Iniciando ambiente de desenvolvimento...
    docker-compose -f ../docker-compose-dev.yaml up
    goto fim
:prod
    echo Iniciando ambiente de produção...
    docker-compose -f ../docker-compose-prod.yaml up
    goto fim
:remover_imagens        
    docker rmi slab_php slab_mysql -f
    goto fim
:testes
    cd ../php/src/
    ./vendor/bin/phpunit tests
    goto fim
:default
    echo Uso: ./slab.sh [ACAO]
    echo.
    echo Argumentos para ACAO
    echo abrir                         Abre o navegador no SLab
    echo dev                           Sobe os containers para desenvolvimento do SLab
    echo prod                          Sobe os containers para ambiente de produção do SLab
    echo remover_imagens               Remove as imagens do ambiente atual
    echo testes                        Executa os testes unitários do PHP
    echo.
    echo Exemplo: sudo ./slab.bat dev
    goto fim
:fim
    ver > NUL
    goto :EOF