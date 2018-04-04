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
    mysql -u $DB_USER -p$DB_PASSWORD -Nse 'show tables' $DB_NAME | while read table; do echo -e "   $table"; mysql -u $DB_USER -p$DB_PASSWORD -e "SET FOREIGN_KEY_CHECKS=0;
    drop table $table" $DB_NAME; echo -e "    done"; done
}

main "$@"
