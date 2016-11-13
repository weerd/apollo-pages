<?php

namespace Weerd\ApolloPages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
