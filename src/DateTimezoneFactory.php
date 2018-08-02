<?php
namespace he\date;
use DateTimeZone;

class DateTimezoneFactory
{
    const ASIA_SHANGHAI = 'Asia/Shanghai';

    const ASIA_CHONGQING = 'Asia/Chongqing';

    public static function getDateTimezone(string $timezone) :DateTimeZone
    {
        return new DateTimeZone($timezone);
    }
}