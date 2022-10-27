#!/bin/bash

sudo docker run -p 13306:3306 --name quiz-mysql1 -e MYSQL_ROOT_PASSWORD=root --rm -i -t quiz-mysql
