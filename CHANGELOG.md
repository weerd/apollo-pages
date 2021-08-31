# Changelog

All notable changes to `apollo-pages` will be documented in this file.

## 1.3.0 - 2021-08-30

This update includes a number of package workflow features and general cleanup.

- Replaces StyleCI to use PHP CS Fixer for code formatting.
- Replaces TravisCI to use GitHub Workflow actions for running tests and formatting code.
- Code formatting updates thanks to PHP CS Fixer and newly defined rules.
- Other general file/directory updates.
- Most of these updates were inspired from @spatie's helpful [Laravel Package Training course](https://laravelpackage.training/).

## 1.2.0 - 2018-04-06

- Adds the [Parsedown](https://github.com/erusev/parsedown) package for handling parsing markdown into markup to save in the `body_markup`.
- Improves the admin interface to use a select dropdown input element if designating a parent page for a new page.
- Updates the `ApolloPage` model to add more convenience accessors and a scope query.
- Adds validation rules to the `update()` method on the Admin Controller.

## 1.1.0 - 2018-03-18

- Adds a series of feature tests for the package.
- Renames the `body_html` column in the `pages` table to `body_markup`, which seems a bit more appropriate.

The change to the column name does not break anything in the package since currently it does not use `body_markup` but is something for a future feature update.

## 1.0.0 - 2017-08-07

- initial release
