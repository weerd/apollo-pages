<?php

namespace Weerd\ApolloPages\Facades;

use Illuminate\Support\Facades\Facade;

class ApolloPages extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'apollopages';
    }
}
