<?php namespace Zaengle\Timezone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Timezone
 *
 * @package Zaengle\Timezone\Facades
 */
class Timezone extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return \Zaengle\Timezone\Timezone::class;
    }
}