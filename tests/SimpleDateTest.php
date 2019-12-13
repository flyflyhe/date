<?php
namespace he\date\test;


use he\date\DateTimeFormat;
use he\date\DateTimeFormatFactory;
use he\date\DateTimezoneFactory;
use he\date\SimpleDate;
use PHPUnit\Framework\TestCase;

class SimpleDateTest extends TestCase
{
    protected $simpleDate;

    protected $dateTime;

    public function setUp(): void
    {
        parent::setUp();
        date_default_timezone_set(DateTimezoneFactory::ASIA_SHANGHAI);
        $this->dateTime = date('Y-m-d H:i:s');
        $this->simpleDate = new SimpleDate(DateTimezoneFactory::getDateTimezone(DateTimezoneFactory::ASIA_SHANGHAI), DateTimeFormatFactory::getDateTimeFormat(DateTimeFormat::MYSQL_DATETIME_FORMAT), $this->dateTime);
    }

    public function testString()
    {
        $this->assertEquals($this->dateTime, $this->simpleDate->string());
    }

    public function testFormat()
    {
        $this->simpleDate->setDateTimeFormat(DateTimeFormatFactory::getDateTimeFormat('Y-m-d H:is'));
        $this->assertEquals(date('Y-m-d H:is', strtotime($this->dateTime)), $this->simpleDate->string());
    }

    public function testAddDay()
    {
        $this->simpleDate->addDay(1);
        $this->assertEquals(date('Y-m-d H:i:s', strtotime($this->dateTime) + 86400), $this->simpleDate->string());
        $this->simpleDate->addDay(-1);
        $this->assertNotEquals(date('Y-m-d H:i:s', strtotime($this->dateTime) - 86400), $this->simpleDate->string());
    }
}