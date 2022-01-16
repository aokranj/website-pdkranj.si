# Database transfers

A short guide how to migrate one environement's database into another environment (i.e. prod to stg).

Prerequisites:
- Access to target environment
- Access to source environment from the target environment
- If target environment is accessible via SSH, authentication forwarding must be enabled
- Source and target environment must have the same WP code deployed



## Steps (stg to docker dev)

Step #1 - Go to your dev environment:
```
cd website-pdkranj.si
```

Step #2 - dump+import the database in one go:
```
ssh pd-stg@stg.pdkranj.si ./www/stg.pdkranj.si/sbin/db-dump | ./sbin/wp db import -
```

Step #3 - fix the URLs in the new database copy
```
./sbin/wp search-replace 'https://stg.pdkranj.si' 'http://docker.dev.pdkranj.si'
```



## Steps (prod to stg)

Step #1 - SSH into the stg environment with auth forwarding enabled (`-A`):
```
ssh pd-stg@stg.pdkranj.si -A
cd www/stg.pdkranj.si
```

Step #2 - dump+import the database in one go:
```
ssh pd-prod@www.pdkranj.si ./www/www.pdkranj.si/sbin/db-dump | ./sbin/wp db import -
```

Step #3 - fix the URLs in the new database copy
```
./sbin/wp search-replace 'https://www.pdkranj.si' 'https://stg.pdkranj.si'
```
