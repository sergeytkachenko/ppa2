#!/usr/bin/env bash
DB="phalcon-ppa"
DRIVER="com.mysql.jdbc.Driver"
CLASSPATH="liquibase-3.4.1-bin/jdbc-driver/mysql-connector-java-5.0.8-bin.jar"
CONNECTION_STRING="jdbc:mysql://localhost/$DB?useUnicode=true&characterEncoding=UTF-8"
DB_USER="root"
DB_PASS="1665017"

if [[ -n "$1" ]]; then
    mysql -u$DB_USER -p$DB_PASS -e "DROP DATABASE IF EXISTS $DB;"
	mysql -u$DB_USER -p$DB_PASS -e "CREATE DATABASE IF NOT EXISTS $DB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"
fi

./liquibase-3.4.1-bin/liquibase --changeLogFile="changelogs/structure.xml" \
    --driver="$DRIVER" \
    --classpath="$CLASSPATH" \
    --url="$CONNECTION_STRING" \
    --username="$DB_USER" \
    --password="$DB_PASS" \
    migrate
