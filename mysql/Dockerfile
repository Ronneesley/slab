FROM mysql:latest

#Configura a senha do usuário root
ENV MYSQL_ROOT_PASSWORD=slab123

ENV MYSQL_DATABASE=slab
ENV MYSQL_USER=slab
ENV MYSQL_PASSWORD=slab123

#Copia os arquivos de criação do banco e de preenchimento inicial
COPY criacao.sql /docker-entrypoint-initdb.d
COPY preenchimento.sql /docker-entrypoint-initdb.d
