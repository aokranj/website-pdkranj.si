#!/bin/bash



### Common script initialization (changes directory into repo root)
#
MYDIR_REL=`dirname $0`
. "$MYDIR_REL/_init-script.sh"



### Configure shell
#
set -e
set -u



### Create temporary directories & set permissions
#
# If you configure new directories here, you need to ensure the same paths have
# PHP processing disabled in the Apache vhost configuration.
#
# Apache vhost configuration can be fount in the following repository:
# https://github.com/aokranj/infrastructure (in the k8s/app-runtime-httpd-php)
#
mkdir -p  public/wp-content/uploads
chmod 777 public/wp-content/uploads



### Update DB structure
#
./sbin/wp core update-db
