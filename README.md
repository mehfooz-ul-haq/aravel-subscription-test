
## Subscription Management System

### Requirements
- PHP v8.x
- Apache
- MySql
- Laravel v11.x

### Set Permissions
run following commands on project root directory to give proper permission to `storage` directory
```shell
$ HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
$ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX storage bootstrap/cache
$ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX storage bootstrap/cache
```

### Application configuration
update `.env` file for database connection and other configurations

```shell
APP_NAME=SubscriptionManagementSystem
APP_ENV=local
APP_DEBUG=false
APP_URL=http://127.0.0.1:8000

# MYSQL DATABASE
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payment
DB_USERNAME=root
DB_PASSWORD=

```

### Generate application key
```shell
$ php artisan key:generate
```

### Install Dependencies
```shell
$ composer install
```
- set directory path to application's `public` directory in apache configuration
- change `storage` permissions to `chown -R www-data:www-data`

run following commands to generate database structure
```shell
$ php artisan migrate
```

### Run Application
```shell
$ php artisan serve
```

### URL for subscription form
```shell
http://127.0.0.1:8000
```