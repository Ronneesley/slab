#!/bin/bash
# Definições para os scripts
# Autor: Ronneesley Moura Teles

#Cores
RED='\033[0;31m'
WHITE='\033[0;37m'
BWHITE='\033[1;37m' #Negrito com branco
GREEN='\033[0;32m'
NC='\033[0m'        #Sem cor

# Verifica se uma operação funcionou
function verificar_operacao {
    if [ $? -eq 0 ]; then 
        echo -e "${GREEN}OK${NC}"
    else
        echo -e "${RED}ERRO${NC}"
    fi
}

#Verifica se o usuário é o root, caso contrário aborta a execução
function verificar_root {
    if [ "$EUID" -ne 0 ]; then 
        echo -e "${BWHITE}Por favor, rode o comando como usuário ${GREEN}root${NC}"
        exit
    fi
}

function instalar_via_apt {
    echo -e "${BWHITE}Instalando os pacotes: ${GREEN}$@${NC}"
    apt install $@
    verificar_operacao
}