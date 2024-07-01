#!/bin/bash

set -e  # Exit immediately if a command exits with a non-zero status
set -u  # Treat unset variables as an error and exit immediately


# Debugging output
echo "Port is: ${NGINX_PORT}"

# Check if the template file exists
if [ ! -f /etc/nginx/conf.d/default.conf.template ]; then
  echo "Template file /etc/nginx/conf.d/default.conf.template not found!"
  exit 1
fi

# Substituting the environment variables in the template file and writing to the actual config file
envsubst '${NGINX_PORT}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

# Validate the new NGINX configuration
nginx -t

# Executing the command passed to the script (default is to start nginx)
exec "$@"
