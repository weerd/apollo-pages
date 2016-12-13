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

Within your Laravel project, open `config/app.php` and, within the `providers` array, append:

```php
'providers' => [
    // ...
    Weerd\ApolloPages\ApolloPagesServiceProvider::class,
    //...
],
```

This will bootstrap the package into Laravel.

### Step 3: Artisan Command

To append the custom routes to your routes file and scaffold the pages controllers, run the following artisan command:

```shell
php artisan apollo:scaffold
```

### Step 4: Migrate

Next, run migration to add the pages table to your database:

```shell
php artisan migrate
```


_more to come..._



## Additional Notes

This package assumes the following directory structure for views with two _master_ page templates:

```
/resources/views/layouts/admin/master.blade.php

/resources/views/layouts/client/master.blade.php
```

These can be freely changed or unified into a single _master_ page template, but you will need to update the references to the master layout templates in the views inside the `/reources/views/pages/admin` and `/reources/views/pages/client` directories.


