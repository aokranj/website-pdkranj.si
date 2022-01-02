#!/bin/bash



### Configure shell
#
set -e
set -u
set -o pipefail



### Do the code upgrade
#
./sbin/wp cli             update
./sbin/wp core            update
./sbin/wp language core   update
./sbin/wp plugin          update --all
./sbin/wp theme           update --all



### Do the DB schema upgrade
#
#./sbin/wp core update-db
