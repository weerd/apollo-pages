<?php

use Faker\Generator as Faker;
use Weerd\ApolloPages\Models\ApolloPage;

/*
|--------------------------------------------------------------------------
| ApolloPage Model Factory
|--------------------------------------------------------------------------
*/

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(ApolloPage::class, function (Faker $faker) {
    $pageTitle = $faker->words(2, true);

    return [
        'slug' => str_slug($pageTitle),
        'path' => str_slug($pageTitle),
        'tier' => 1,
        'parent_id' => null,
        'title' => ucfirst($pageTitle),
        'body_raw' => null,
        'body' => null,
    ];
});
