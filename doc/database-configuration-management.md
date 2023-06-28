# Database configuration management

WARNING: The state of this feature is considered ALPHA quality. Use at your own risk.



## What is this?

This is an attempt to manage the `wp_options` content and replicate changes between environments.

We're using [wp-cli-confmaps](https://github.com/wp-cli-confmaps/wp-cli-confmaps) plugin for this.



## How to use?

Commands:
```
wp confmaps apply --dry-run
wp confmaps apply --commit
wp confmaps update
```

See plugin's README.md for more information.
