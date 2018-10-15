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
        return config('timezone.timezones');
    }

    /**
     * @param null $selected
     * @param null $placeholder
     * @param array $selectAttributes
     * @param array $optionAttributes
     *
     * @return string
     */
    public function selectForm(
        $selected = null,
        $placeholder = null,
        array $selectAttributes = [],
        array $optionAttributes = []
    ) {
        $selectAttributesString = '';
        foreach ($selectAttributes as $key => $value) {
            $selectAttributesString = $selectAttributesString." ".$key."='".$value."'";
        }

        $optionAttributesString = '';
        foreach ($optionAttributes as $key => $value) {
            $optionAttributesString = $optionAttributesString." ".$key."='".$value."'";
        }

        $string = "<select".$selectAttributesString.">\n";

        if (isset($placeholder) && (empty($selected))) {
            $placeholder = "<option value='' disabled selected>{$placeholder}</option>";
        } else {
            $placeholder = null;
        }

        $string = $string.$placeholder;
        foreach (config('timezone.timezones') as $key => $value) {
            if ($selected == $value) {
                $selectedString = "selected='".$value."'";
            } else {
                $selectedString = '';
            }

            $string = $string."<option value='".$value."'".$optionAttributesString." ".$selectedString.">".$key."</option>\n";
        }
        $string = $string."</select>";

        return $string;
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
