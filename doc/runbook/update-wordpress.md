# Upgrading WordPress

A short guide how to upgrade and deploy updated WP to all environments.

For this guide, let's assume the following configuration of remotes in your git repository (TL;DR branch `master` is `tracking aokranj/website-pdkranj.si:master`, ditto for `prod`):
```
$ git remote -v
origin  git@github.com:bostjan/website-pdkranj.si.git (fetch)
origin  git@github.com:bostjan/website-pdkranj.si.git (push)
upstream        git@github.com:aokranj/website-pdkranj.si (fetch)
upstream        git@github.com:aokranj/website-pdkranj.si (push)

$ git br -vv -a
* master                  5e2a5a8 [upstream/master: ahead 2] conf: Change default email to janez.nastran[@]gmail.com + disable verification until sometime in 2030
  prod                    df8b648 [upstream/prod] Revert "Add plugin: the-events-calendar v5.7.0"
  remotes/origin/master   d50dd71 Update README.md
  remotes/upstream/HEAD   -> upstream/master
  remotes/upstream/master 10249de Merge pull request #12 from bostjan/docker-compose-dev-env
  remotes/upstream/prod   df8b648 Revert "Add plugin: the-events-calendar v5.7.0"
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
or 
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
git push -u origin update-YYYY-MM-DD
```



## Deploy to staging

**Step #6** - Push `master` to upstream repository (deploy to STG)
```
git push   # or `git push upstream master`, if "upstream" is the name of the aokranj/website-pdkranj.si
```
This will automatically deploy the new version to https://stg.pdkranj.si in a few seconds/minutes.
You can monitor the deployment progress at https://github.com/aokranj/website-pdkranj.si/actions.
If this step fails, you can manually deploy to STG as follows:
```
ssh pd-stg@stg.pdkranj.si -A

# Then as `pd-stg` user on the host system:
cd www/stg.pdkranj.si
git pull
./sbin/deploy-here
```
Done.



## Deploy to production - OBSOLETE, NEEDS A REFRESH, TODO

**Step #7** - To deploy to production - Part #1 - Merge branch `master` into `prod`:
```
# Back in your own repository clone
git checkout prod
git merge --ff master
git push   # or `git push upstream prod`
```
`prod` branch is the branch containing our production code.

**Step #8** - To deploy to production - **Part #2** - Deploy `prod` to production:
```
ssh pd-prod@www.pdkranj.si -A
cd www/www.pdkranj.si
# At this point, `prod` branch should already be checked out here
git pull
./sbin/deploy-here
```
Done.



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
