# Database transfers

A short guide how to migrate one environement's database into another environment (i.e. prod to stg).

Prerequisites:
- Access to target environment
- Access to source environment from the target environment
- Source and target environment must have the same WP tooling deployed



## Steps (prod|stg >> local docker dev)

Step #1 - Go to your dev environment:
```
cd website-pdkranj.si
```

Step #2 - Dump+import the database in one go:
```
ssh www.pdkranj.si /data/ao-prod/www.pdkranj.si/sbin/db-dump | ./sbin/wp db import -   # From PROD
ssh stg.pdkranj.si /data/ao-stg/stg.pdkranj.si/sbin/db-dump  | ./sbin/wp db import -   # From STG
```

Step #3 - Fix the URLs in the new database copy:
```
./sbin/wp search-replace 'https://www.pdkranj.si' 'https://docker.dev.pdkranj.si'   # From PROD
./sbin/wp search-replace 'https://stg.pdkranj.si' 'https://docker.dev.pdkranj.si'   # From STG
```



## Steps (prod|stg >> on-server dev)

Step #1 - Go to your dev environment:
```
ssh YOURHOST.dev.pdkranj.so
cd www/YOURHOST.dev.pdkranj.si
```

Step #2 - Dump+import the database in one go:
```
/data/ao-prod/www.pdkranj.si/sbin/db-dump | ./sbin/wp db import -   # From PROD
/data/ao-stg/stg.pdkranj.si/sbin/db-dump  | ./sbin/wp db import -   # From STG
```

Step #3 - Fix the URLs in the new database copy:
```
./sbin/wp search-replace 'https://www.pdkranj.si' 'https://YOURHOST.dev.pdkranj.si'   # From PROD
./sbin/wp search-replace 'https://stg.pdkranj.si' 'https://YOURHOST.dev.pdkranj.si'   # From STG
```



## Steps (prod >> stg)

Step #1 - SSH into the stg environment with auth forwarding enabled (`-A`):
```
ssh stg.pdkranj.si
cd /data/ao-stg/stg.pdkranj.si
```

Step #2 - Dump+import the database in one go (from PROD):
```
/data/ao-prod/www.pdkranj.si/sbin/db-dump | ./sbin/wp db import -
```

Step #3 - Fix the URLs in the new database copy:
```
./sbin/wp search-replace 'https://www.pdkranj.si' 'https://stg.pdkranj.si'
```
