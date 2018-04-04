#!/bin/bash
DIR=$(dirname "$0")

function check_dbconfig() {
    if [ -e $DIR/db.config ]; then
        source $DIR/db.config
    else
        echo -e "check if db.config exists \n"
        exit 1
    fi
}

function main() {
    check_dbconfig
    echo "protect data - dump db - by Justin Case"
    $DIR/db_dump.sh
    echo -e "clean db\n"
    $DIR/db_clean.sh
    echo -e "create db structure\n"
    mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $DIR/struct.sql
    echo -e "import sample data\n"
    mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $DIR/sample_data.sql
}

main "$@"
