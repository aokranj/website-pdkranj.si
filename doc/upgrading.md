# Upgrading WordPress

A short guide how to upgrade and deploy updated WP to all environments



## Import new WP version (i.e. in your dev environment)

Step 1 - upgrade the code:
```
./sbin/upgrade-code.sh
```

Step 2 - migrate the database:
```
./sbin/wp core update-db
```
Now verify the upgraded version.

Step 3 - commit:
```
git add .
git commit
```
Add the upgrade output to the commit message.



## Upgrade once new version is already committed

Upgrading other instances (staging, production) is even simpler.

Step 1 - pull the new code:
```
git pull
```

Step 2 - migrade the database
```
./sbin/wp core update-db
```
