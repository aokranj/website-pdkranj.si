# Database transfers

A short guide how to migrate one environement's database into another environment (i.e. prod to stg).



## Steps

Step #1 - dump the production database:
```
ssh pd-prod@www.pdkranj.si
cd www/www.pdkranj.si

./sbin/db-dump > pd-prod.sql
```
Now transfer the generated dump file over to the stg environment.

Step #2 - import the database dump into the staging database:
```
./sbin/wp db import pd-prod.sql
```

Step #3 - adjust the URLs embedded in the database content:
```
./sbin/wp search-replace 'https://www.pdkranj.si' 'https://stg.pdkranj.si'
```
After this is done, you'll probably need to transfer the `public/wp-content/uploads` content too.
