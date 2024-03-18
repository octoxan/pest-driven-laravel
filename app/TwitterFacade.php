<?php

namespace App;

use Illuminate\Support\Facades\Facade;
use Tests\Feature\Fakes\TwitterFake;

/**
 * @see TwitterFake
 * @see TwitterClient
 */
class TwitterFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'twitter';
    }

    public static function fake(): void
    {
        self::swap(new TwitterFake());
    }
}
