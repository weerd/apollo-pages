<h1 align="center">Laravel Apollo Pages</h1>

<h2 align="center">Create &amp; Manage Simple Static Pages</h2>

<p align="center">
    <a href="https://travis-ci.org/weerd/apollo-pages">
        <img src="https://travis-ci.org/weerd/apollo-pages.svg?branch=master" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/weerd/apollo-pages">
        <img src="https://poser.pugx.org/weerd/apollo-pages/v/stable.svg?format=flat" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/weerd/apollo-pages">
        <img src="https://poser.pugx.org/weerd/apollo-pages/license.svg?format=flat" alt="License">
    </a>
</p>

## Introduction

**Apollo Pages** is a package for [Laravel](https://laravel.com/) that provides scaffolding and functionality for generating and presenting static pages in a plug-and-play, CMS-like fashion.

The package sets up a very bare-bones administrative interface that is specifically designed to help with creating and managing simple static-content pages and subpages, written in markdown without the need to define any custom routes.

The administrative interface is entirely just HTML so it can be customized to your liking. Developers can publish the package views to their project and fully customize them as needed.

It all works fine out of the box, it just needs a fresh coat of paint. I highly recommend using something like [Tailwind CSS](https://tailwindcss.com/), [Bootstrap](https://getbootstrap.com/), rolling your own or integrating it into your existing administration interface styles.

## Installation

### Step 1: Composer

From the command line, run:

```shell
$ composer require weerd/apollo-pages
```

### Step 2: Service Provider

Within your Laravel project, open `config/app.php` and, at the end of the `providers` array, include the `ApolloPagesServiceProvider`.

For example:

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

**Important note**: this will bootstrap the package into Laravel. To have `ApolloPages` work correctly and behave as a catch all for routes specifiying custom pages, the routes for the package need to be considered _after_ the main application routes defined in `/routes/web.php`. For this behavior, the `ApolloPagesServiceProvider` needs to be defined at the very end of the `providers` array.

### Step 3: Migrate

Next, run the migration to add the `pages` table to your database:

```shell
$ php artisan migrate
```

### Step 4: Confirmation

This step is optional, but if you would like to confirm that the installation is working and the package routes are registering as expected, load up your project in a browser and head to `yourproject.test/status/apollo` (replace `yourproject.test` with the URL for your project).

You should see this JSON response confirming all is well:

```json
{
    "status": "Apollo Pages routes are working!"
}
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

## Usage

Once everything is setup, authenticate as an admin into your application and then head to `yourproject.test/admin/pages` to create and manage your static pages.

The default `ApolloPages\Http\Controllers\Admin\PageController.php` which controls the administration of pages utilizes the `auth` middleware, so you will need to have an authentication system setup to use it.

You can easily do this by running `php artisan make:auth` on a fresh Laravel application. However, you can also override this behavior by just creating your own administrative page controller and extending `ApolloPages\Http\Controllers\Admin\PageController.php` to modify or extend its functionality.

Anyhoo, the world is your oyster, so go wild!

### Creating Pages

On the "pages" index at `yourproject.test/admin/pages`, click on the "Add new page" link to head to the `admin/pages/create` view which has the following fields:

-   **Title**: enter a title for the page.
-   **Slug**: enter a slug for the page URL (the value entered will be converted to kebab case).
-   **Parent page**: define if this page is a subpage (child) of a previously created page; if no other pages exist, dropdown is empty.
-   **Body**: the body content of the page as markdown.

Fill out the fields and submit the form to create the new page. You can then click to view this newly created page from the `/admin/pages` index list of pages.

You can create as many top level pages or subpages as you desire.

Enjoy!

## Credits

-   [Diego Lorenzo](https://github.com/weerd)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information
