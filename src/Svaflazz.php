<?php

namespace Svakode\Svaflazz;

use Illuminate\Support\Facades\Facade;

/**
 * Class SvaflazzFacade
 * @package Svakode\Svaflazz
 */
class Svaflazz extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'svaflazz';
    }
}
