#!/bin/bash

set -e

if [[ $CONTAINER_ROLE == "server" ]]
then
    echo "Starting Server..."
else 
    echo "Starting ${CONTAINER_ROLE}..."
fi 
