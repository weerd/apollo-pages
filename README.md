# Apollo Pages

Apollo Pages is a package for Laravel 5 that provides scaffolding and functionality for generating static pages in a CMS-like nature.

_more to come..._

## Installation

### Step 1: Composer

From the command line, run:

```shell
composer require ... // the project is still in development and will be on packagist.org soon
```

### Step 2: Service Provider

Within your Laravel project, open `config/app.php` and, within the `providers` array, append:

```php
'providers' => [
    // ...
    DoSomething\Gateway\Laravel\GatewayServiceProvider::class,
    //...
],
```

This will bootstrap the package into Laravel.

### Step 3: Artisan Command

To append the custom routes to your routes file and scaffold the pages controllers, run the following artisan command:

```shell
php artisan apollo:scaffold
```

_more to come..._
