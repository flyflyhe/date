<?php
namespace he\date;

class DateTimeFormatFactory
{
    public static function getDateTimeFormat(string $formatName) :DateTimeFormat
    {
        return new DateTimeFormat($formatName);
    }
}