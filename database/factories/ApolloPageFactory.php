<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use Weerd\ApolloPages\Models\ApolloPage;

/*
|--------------------------------------------------------------------------
| ApolloPage Model Factory
|--------------------------------------------------------------------------
*/

$factory->define(ApolloPage::class, function (Faker $faker) {
    $pageTitle = $faker->words(2, true);

    return [
        'slug' => Str::slug($pageTitle),
        'path' => Str::slug($pageTitle),
        'tier' => 1,
        'parent_id' => null,
        'title' => ucfirst($pageTitle),
        'body' => null,
        'body_markup' => null,
    ];
});
