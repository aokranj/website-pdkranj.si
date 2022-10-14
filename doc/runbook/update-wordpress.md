# Upgrading WordPress

A short guide how to upgrade and deploy updated WP to all environments.

For this guide, let's assume the following configuration of remotes in your git repository (TL;DR branch `master` is `aokranj/website-pdkranj.si:master`):
```
$ git remote -v
origin  git@github.com:bostjan/website-pdkranj.si.git (fetch)
origin  git@github.com:bostjan/website-pdkranj.si.git (push)
upstream        git@github.com:aokranj/website-pdkranj.si (fetch)
upstream        git@github.com:aokranj/website-pdkranj.si (push)

$ git br -vv -a
* master                  5e2a5a8 [upstream/master: ahead 2] conf: Change default email to janez.nastran[@]gmail.com + disable verification until sometime in 2030
  remotes/origin/master   d50dd71 Update README.md
  remotes/upstream/HEAD   -> upstream/master
  remotes/upstream/master 10249de Merge pull request #12 from bostjan/docker-compose-dev-env
$
```



## Upgrade to the latest WordPress version (i.e. in your dev environment)

** Step #1** - Start on the `master` branch, make sure it is in-sync with the upstream remote (if you haven't already):
```
git checkout master
git pull
```
Here, make sure that you're pulling from the correct remote repository
(from `github.com:aokranj/website-pdkranj.si` and not from `github.com:YOURUSERNAME/website-pdkranj.si`).

**Step #2** - Create a dedicated branch:
```
git checkout -b update-YYYY-MM-DD
```
or something more meaningful, like:
```
git checkout -b update-to-6.0.2
```

**Step #3** - Upgrade everything (creates dedicated commits):
```
./sbin/update-all
```

**Step #4** - Verify the upgraded version (click around, make sure it works as expected).


**Step #5** - Create a pull request:
```
git push -u origin <YOUR-BRANCH-NAME>
```



## Deploy to staging

Follow the [runbook for deploying to staging](deploy-to-stg.md).



## Deploy to production

Follow the [runbook for deploying to production](deploy-to-prod.md).



## How to pull the newer WordPress version from our git upstream

**Step #1** - Pull the new code:
```
git pull
```

**Step #2 - Migrate the database + do other deployment-related tasks:
```
./sbin/deploy-here
```
That's it.
