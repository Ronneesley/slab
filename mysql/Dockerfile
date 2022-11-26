FROM mysql:8.0.31
ENV MYSQL_ROOT_PASSWORD = quiz
ENV MYSQL_USER = quiz
ENV MYSQL_PASSWORD = quiz
COPY criacao.sql /docker-entrypoint-initdb.d
CMD ["/bin/bash"]
