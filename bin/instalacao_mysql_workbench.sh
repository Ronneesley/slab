#!/bin/bash

sudo snap install mysql-workbench-community

sudo snap connect mysql-workbench-community:password-manager-service :password-manager-service
