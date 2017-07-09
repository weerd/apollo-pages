# Apollo Pages

Apollo Pages is a package for Laravel 5 that provides scaffolding and functionality for generating static pages in a CMS-like nature.

_more to come..._

## Installation

### Step 1: Composer

From the command line, run:

```shell
composer require ... # the project is still in development and will be on packagist.org soon
```

### Step 2: Service Provider

Within your Laravel project, open `config/app.php` and, at then end of the `providers` array, append:

```php
'providers' => [
    // ...

    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,

    /*
     * Post-Application Package Service Providers...
     */
    Weerd\ApolloPages\ApolloPagesServiceProvider::class,
],
```

This will bootstrap the package into Laravel. To have `ApolloPages` work correctly and behave as a catch all for routes specifiying custom pages, the routes for the package need to be considered _after_ the main application routes defined in `/routes/web.php`. For this behavior, the `ApolloPagesServiceProvider` needs to be defined at the very end of the `providers` array.

### Step 3: Migrate

Next, run migration to add the pages table to your database:

```shell
php artisan migrate
```


_more to come..._



## Customization

_more to come..._



## Additional Notes

This package assumes the following directory structure for views with two _master_ page templates:

```
/resources/views/layouts/admin/master.blade.php

/resources/views/layouts/client/master.blade.php
```

These can be freely changed or unified into a single _master_ page template, but you will need to update the references to the master layout templates in the views inside the `/reources/views/pages/admin` and `/reources/views/pages/client` directories.


