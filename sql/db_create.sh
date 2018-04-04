#!/bin/bash

## Uncomment it for debugging purpose
# set -o errexit
# set -o pipefail
# set -o nounset
# set -o xtrace

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

    echo -n "Enter your mysql root password > "
    read PASSWORD

    echo -e "create db\n"
    mysql -u root -p$PASSWORD < $DIR/create.sql
    echo -e "create db schema\n"
    mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $DIR/struct.sql
    echo -e "import sample data\n"
    mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $DIR/sample_data.sql

    echo -e "\n FINISHED \n"
}

main "$@"
