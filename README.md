<h1 align="center">Apollo Pages</h1>
[![License](https://poser.pugx.org/weerd/apollo-pages/license?format=flat-square)](https://packagist.org/packages/weerd/apollo-pages)
[![Latest Stable Version](https://poser.pugx.org/weerd/apollo-pages/v/stable?format=flat-square)](https://packagist.org/packages/weerd/apollo-pages)


## Introduction

Apollo Pages is a package for Laravel 5 that provides scaffolding and functionality for generating static pages in a CMS-like nature.



## Installation

### Step 1: Composer

From the command line, run:

```shell
composer require weerd/apollo-pages
```

### Step 2: Service Provider

Within your Laravel project, open `config/app.php` and, at the end of the `providers` array, append:

```php
'providers' => [
    // ...

    /*
     * Application Service Providers...
     */
    // ...

    /*
     * Post-Application Package Service Providers...
     */
    Weerd\ApolloPages\ApolloPagesServiceProvider::class,
],
```

This will bootstrap the package into Laravel. To have `ApolloPages` work correctly and behave as a catch all for routes specifiying custom pages, the routes for the package need to be considered _after_ the main application routes defined in `/routes/web.php`. For this behavior, the `ApolloPagesServiceProvider` needs to be defined at the very end of the `providers` array.

### Step 3: Migrate

Next, run the migration to add the `pages` table to your database:

```shell
php artisan migrate
```



## Customization

### Publish Vendor Files

The `ApolloPages` package makes use of the `artisan publish` command to allow user's to publish some of this package's files to their project so that they can easily be overridden and customized by the package user.

You can publish all available publishable package files to your project by running:

```shell
$ php artisan vendor:publish --provider="Weerd\ApolloPages\ApolloPagesServiceProvider"
```

Alternatively, you can publish just the view files to your project by running:

```shell
$ php artisan vendor:publish --tag="apollo-pages-views"
```

For a third option, as of Laravel 5.5 you can use the provider prompt to select which provider or tag's files to publish by running:

```shell
$ php artisan vendor:publish
```

And then follow the prompt.

