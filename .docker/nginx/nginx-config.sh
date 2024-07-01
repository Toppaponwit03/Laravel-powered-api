#!/bin/bash

echo 'Port is :' ${NGINX_PORT}

# Substituting the environment variables in the template file and writing to the actual config file
envsubst '${NGINX_PORT}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

# Executing the command passed to the script (default is to start nginx)
exec "$@"
