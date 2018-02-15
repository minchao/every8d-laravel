<?php

namespace Every8d\Laravel\Facade;

use Illuminate\Support\Facades\Facade;
use Every8d\Client;

class Every8d extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
