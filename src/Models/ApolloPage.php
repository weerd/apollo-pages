<?php

namespace Weerd\ApolloPages\Models;

use Illuminate\Database\Eloquent\Model;

class ApolloPage extends Model
{
	/**
	 * Find the specified page by its slug.
	 *
	 * @param string $slug
	 */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
