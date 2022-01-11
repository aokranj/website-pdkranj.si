# Database configuration management

WARNING: The state of this feature is considered ALPHA quality. Use at your own risk.



## What is this?

This is an attempt to manage the `wp_options` content and replicate changes between environments.

We're using [wp-cli-configmaps](https://github.com/wp-cli-configmaps/wp-cli-configmaps) plugin for this.



## How to use?

Commands:
```
wp configmaps apply --dry-run
wp configmaps update
```

See plugin's README.md for more information.
