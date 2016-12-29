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

    /**
     * Assign page attributes that need to be processed first.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Request
     */
    public static function assignProcessedAttributes($request)
    {
        $request['slug'] = static::assignSlugAttribute($request);

        $request['path'] = static::assignPathAttribute($request);

        $request['tier'] = static::assignTierAttribute($request);

        return $request;
    }

    /**
     * Assign path attribute based on slug and if page contains a parent id.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public static function assignPathAttribute($request)
    {
        $parent = static::where('id', $request->input('parent_id'))->first();

        if ($parent) {
            return $parent->path.'/'.$request->input('slug');
        }

        return $request->input('slug');
    }

    /**
     * Assign slug attirbute based on provided value or the page title.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public static function assignSlugAttribute($request)
    {
        $value = $request->input('slug');

        if (empty($value)) {
            $value = $request->input('title');
        }

        return str_slug($value);
    }

    /**
     * Assign tier attribute based on whether page is nested under a parent page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return int
     */
    public static function assignTierAttribute($request)
    {
        $parent = static::where('id', $request->input('parent_id'))->first();

        if ($parent) {
            return $parent->tier + 1;
        }

        return 1;
    }

    /**
     * Set the slug for the page.
     *
     * @param  string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Set the parent id for the page.
     *
     * @param  string $value
     * @return void
     */
    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = empty($value) ? null : $value;
    }
}
