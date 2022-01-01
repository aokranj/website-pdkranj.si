#!/bin/bash



### Configure shell
#
set -e
set -u



### Create temporary directories & set permissions - TODO
#
# If you configure new directories here, you need to ensure the same paths have
# PHP processing disabled in the Apache vhost configuration.
#
# Apache vhost configuration can be fount in the following repository:
# https://github.com/aokranj/infrastructure (in the k8s/app-runtime-httpd-php)
#
mkdir -p  public/wp-content/uploads
chmod 777 public/wp-content/uploads

#mkdir -p  public/tmp
#chmod 777 public/tmp

#mkdir -p  public/wp-content/plugins/si-captcha-for-wordpress/captcha/cache
#chmod 777 public/wp-content/plugins/si-captcha-for-wordpress/captcha/cache



### Update DB structure
#
#cd ./public
#./wp core update-db
