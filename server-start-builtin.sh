#!/bin/sh

# quickly launch php builtin server - choose port

if [ $# -eq 0 ]
  then
    echo -e "usage: bash $(basename "$0") 8081 or other port \n"
    exit 1
fi

PORT=$1

echo -e "Launching php builtin server on port "$PORT" \n"

php -S 0.0.0.0:$PORT -t app/public/

