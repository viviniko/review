<?php

namespace Viviniko\Review\Facades;

use Illuminate\Support\Facades\Facade;

class Review extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Viviniko\Review\Contracts\ReviewService::class;
    }
}