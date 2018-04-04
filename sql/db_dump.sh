#!/usr/bin/env bash

## Uncomment it for debugging purpose
# set -o errexit
# set -o pipefail
# set -o nounset
# set -o xtrace

# running dir
DIR=$(dirname "$0")
NOW=`date +%Y%m%d`


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
    bkpName="db-dump-`hostname`-$NOW.$DB_NAME.sql"
    logFile="db-dump-`hostname`-$NOW.$DB_NAME.log"

    echo -e "db dump \n"
    mysqldump -u $DB_USER -p$DB_PASSWORD --databases $DB_NAME --routines > $DIR/$bkpName 2>$DIR/$logFile

    echo -e "$DB_NAME dumped"

    gzip $DIR/$bkpName

    echo -e "$DB_NAME gzipped \n"
}


main "$@"
