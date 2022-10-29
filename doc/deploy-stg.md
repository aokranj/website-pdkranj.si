# How to deploy to staging

General information:
- Deployments to staging are **automated**
- Whatever lands on a git branch `master` is automatically deployed to staging
- The repo clone used for deployment should already have `master` branch checked out,
- The repo clone used for deployment should be tracking the `git@github.com:aokranj/website-pdkranj.si` upstream repository
- You need to be added to the system group `pd-stg` to be able to manually deploy to staging



## Automated deployment

You can trigger the automated deployment by:
- Pushing anything into the `master` branch of the `github.com:aokranj/website-pdkranj.si` repository
- Merging a PR into the `master` branch in the `github.com:aokranj/website-pdkranj.si` repository
- Running a deployment action manually on GitHub

You can follow the progress of automated deployments [here](https://github.com/aokranj/website-pdkranj.si/actions).



## Manual deployment

**WARNING:** This method should only be used if automated deployment fails for some reason.
Make sure that automated deployments are not interfering with your manual work.

**Step #1** - `ssh` (with `-A`!):
```
ssh YOUR-USERNAME@stg.pdkranj.si -A
```

**Step #2** - `cd`:
```
cd /data/pd-stg/stg.pdkranj.si
```

**Step #3** - `git pull`:
```
git pull
```

**Step #4** - Run the deployment script:
```
./sbin/deploy-here
```

**Step #5** - Verify configuration:
```
./wp confmaps verify
```

All done.



### Working as `pd-stg` user

While the majority of regular devops operations can be performed as a member of `pd-stg` system group,
some tasks may need you to become the actual `pd-stg` _user_.
One such operation is managing file permissions.

To work as a `pd-stg` user, use `sudo` like this:
```
sudo -u pd-stg -s
```
