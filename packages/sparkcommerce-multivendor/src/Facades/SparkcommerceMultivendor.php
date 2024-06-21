<?php

namespace Rahat1994\SparkcommerceMultivendor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rahat1994\SparkcommerceMultivendor\SparkcommerceMultivendor
 */
class SparkcommerceMultivendor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rahat1994\SparkcommerceMultivendor\SparkcommerceMultivendor::class;
    }
}
