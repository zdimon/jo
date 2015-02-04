# Script bash
# Auteur		    : P.RAMAGE - <webmaster@leworm.fr>
# Date de création	: 08 janv. 2012
# Description       :

#!/bin/sh


# Constantes
Base="${1}"
User="${2}"

# Variables


# main
psql -h webdev -U postgres -W -c "drop database "${Base}""
psql -h webdev -U postgres -W -c "create database "${Base}""


