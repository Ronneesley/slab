FROM mysql:latest

#Configura a senha do usuário root
ENV MYSQL_ROOT_PASSWORD=quiz123

ENV MYSQL_DATABASE=quizestatistico
ENV MYSQL_USER=quiz
ENV MYSQL_PASSWORD=quiz123

COPY criacao.sql /docker-entrypoint-initdb.d
COPY quizestatistico_preenchimento.sql /docker-entrypoint-initdb.d
