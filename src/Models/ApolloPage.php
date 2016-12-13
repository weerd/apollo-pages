<?php

namespace Weerd\ApolloPages\Models;

use Illuminate\Database\Eloquent\Model;

class ApolloPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Set the guarded attributes for the model.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

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
