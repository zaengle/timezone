<?php namespace Zaengle\Timezone;

use DateTime;
use DateTimeZone;

/**
 * Class Timezone
 *
 * @package Zaengle\Timezone
 */
class Timezone
{
    /**
     * @return array
     */
    public function getTimezones()
    {
        return collect(config('timezone.timezones'))
            ->filter(function($timezone) {
                return $timezone['enabled'] === true;
            })->map(function($timezone) {
                return [
                    'id' => $timezone['id'],
                    'title' => $timezone['title']
                ];
            });
    }

    /**
     * @return mixed
     */
    public function toSelectArray()
    {
        return $this->getTimezones()
            ->mapWithKeys(function($timezone) {
                return [$timezone['id'] => $timezone['title']];
            });
    }

    /**
     * @param integer $timestamp
     * @param string $timezone
     * @param string $format
     *
     * @return string
     */
    public function convertFromUTC($timestamp, $timezone, $format = 'Y-m-d H:i:s')
    {
        $date = new DateTime($timestamp, new DateTimeZone('UTC'));

        $date->setTimezone(new DateTimeZone($timezone));

        return $date->format($format);
    }

    /**
     * @param integer $timestamp
     * @param string $timezone
     * @param string $format
     *
     * @return string
     */
    public function convertToUTC($timestamp, $timezone, $format = 'Y-m-d H:i:s')
    {
        $date = new DateTime($timestamp, new DateTimeZone($timezone));

        $date->setTimezone(new DateTimeZone('UTC'));

        return $date->format($format);
    }
}
