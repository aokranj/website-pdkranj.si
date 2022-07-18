# PD Kranj Theme

https://github.com/babobski/Bootstrap-on-WordPress

## Installation

**TODO: dockerize development workflow**

1. Run pdkranj on localhost `http://pdkranj.local`

```sh
# add to hosts file
127.0.1.1       pdkranj.local
```

2. Apache config should look something like this

```
<VirtualHost *:80>
    ServerAdmin user@localhost
    ServerName pdkranj.local
    DocumentRoot /path/to/pdkranj/public

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /path/to/pdkranj/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

3. Update `wp-config.php` file

```php
define('WP_HOME',    'http://pdkranj.local');
define('WP_SITEURL', 'http://pdkranj.local');

define('WP_DEBUG', true);
define('FORCE_SSL_ADMIN', false);
define('FS_METHOD', 'direct');
```

4. Install node modules

```sh
npm install
```

## Development

Run dev mode with webpack and browsersync

```sh
npm run dev
```

## Build

Build theme into `dist` folder

```sh
npm run build
```
