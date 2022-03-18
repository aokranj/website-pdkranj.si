# How to deploy to production

Two methods:
- Trigger an automated deployment (by pushing a correct git tag to the upstream repository)
- Manual procedure



## Triggering automated deployment - initial setup


### Configure commit/tag signature settings

If you're working on a local system, 
add the following to your `.git/config` or `~/.gitconfig`:
```
[gpg]
    format = ssh
[gpg "ssh"]
    defaultKeyCommand = cat /home/YOUR-USERNAME-HERE/.ssh/id_rsa.pub
[commit]
    gpgsign = true  # Only if you want to sign all commits (recommended)
```

Alternatively, if you're working on a remote system to which you forward your SSH agent socket,
add the following to your `.git/config` or `~/.gitconfig`:
```
[gpg]
    format = ssh
[gpg "ssh"]
    defaultKeyCommand = ssh-add -L
[commit]
    gpgsign = true  # Only if you want to sign all commits (recommended)
```

The [sbin/deploy-prod](../sbin/deploy-prod) command ensures that tag creation contains a signature (it uses the `-s` flag),
therefore no additional configuration is required.


### Authorize your SSH public key

Make sure your SSH public key is added to the [list of keys approved for triggering deployment to production](../sbin/deploy-prod-verify-tag.keylist).



## Automated deployment

General information:
- Deployments are implemented with git tags
- The latest `prod-*` tag is the one currently deployed in production

Prerequisites:
- The repo used for triggering a deployment must have a `git@github.com:aokranj/website-pdkranj.si` remote configured


** Step #1** - Trigger the automated deployment:
```
./sbin/deploy-prod -y
```

** Step #2** - Follow the automated deployment:

Here: https://github.com/aokranj/website-pdkranj.si/actions/workflows/deploy-prod.yml

** Step #3** - If needed, manually handle the (re)configuration tasks:
```
# Follow steps #1, #2, #4 and #5 below.
```



## Manual deployment

Prerequisites:
- You need to be added to the system group `pd-prod` to be able to manually deploy to production.

**WARNING:** This method should only be used if automated deployment fails for some reason.
Make sure that automated deployments are not interfering with your manual work.

**Step #1** - `ssh` (with `-A`!):
```
ssh YOUR-USERNAME@www.pdkranj.si -A
```

**Step #2** - `cd`:
```
cd /data/pd-prod/www.pdkranj.si
```

**Step #3** - `git fetch`:
```
git fetch
```

**Step #4** - Checkout the intended version:
```
git checkout prod-XXXXXX-XXXXXX
git checkout <COMMIT-ID>
git checkout master
```

**Step #5** - Run the deployment script:
```
./sbin/deploy-here
```

**Step #6** - Verify configuration:
```
./wp configmaps verify
```

All done.



### Working as `pd-prod` user

While the majority of regular devops operations can be performed as a member of `pd-prod` system group,
some tasks may need you to become the actual `pd-prod` _user_.
One such operation is managing file permissions.

To work as a `pd-prod` user, use `sudo` like this:
```
sudo -u pd-prod -s
```
