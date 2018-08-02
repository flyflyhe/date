<?php
namespace he\date\test;

require dirname(dirname(__DIR__))."/vendor/autoload.php";

use he\date\DateTimeFormat;
use he\date\DateTimeFormatFactory;
use he\date\DateTimezoneFactory;
use he\date\SimpleDate;

class SimpleDateTest
{
    protected $simpleDate;

    public function __construct()
    {
        $this->simpleDate = new SimpleDate(DateTimezoneFactory::getDateTimezone(DateTimezoneFactory::ASIA_SHANGHAI),
            DateTimeFormatFactory::getDateTimeFormat(DateTimeFormat::MYSQL_DATETIME_FORMAT));
    }

    public function testGetOneFirstMonthDay(int $pointer)
    {
        return $this->simpleDate->getOneMonthFirstDay($pointer);
    }
}

$test = new SimpleDateTest();
echo $test->testGetOneFirstMonthDay(0).PHP_EOL;
echo $test->testGetOneFirstMonthDay(-1);