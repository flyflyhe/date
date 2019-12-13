<?php
namespace he\date;

use DateTime;
use DateTimeZone;
use DateInterval;
use Exception;

class SimpleDate
{
    protected $dateTimezone = null;

    protected $dateTimeFormat = null;

    protected $dateTime;

    /**
     * SimpleDate constructor.
     * @param DateTimeZone $dateTimeZone
     * @param DateTimeFormat $dateTimeFormat
     * @param string $time
     * @throws Exception
     */
    public function __construct(DateTimeZone $dateTimeZone, DateTimeFormat $dateTimeFormat, string $time = 'now')
    {
        $this->setDateTimezone($dateTimeZone);
        $this->setDateTimeFormat($dateTimeFormat);
        $this->dateTime = new DateTime($time);
    }

    /**
     * @param DateTimeZone $dateTimeZone
     * @throws Exception
     */
    public function setDateTimezone(DateTimeZone $dateTimeZone) :void
    {
        #DateTime第一个参数传时间戳等含有时区信息的参数 会导致后一个失去信息失败
        $this->dateTimezone = new DateTime("now", $dateTimeZone);
    }


    /**
     * @return DateTimeZone
     */
    public function getDateTimezone() :DateTimeZone
    {
        return $this->dateTimezone;
    }

    /**
     * @param DateTimeFormat $dateTimeFormat
     */
    public function setDateTimeFormat(DateTimeFormat $dateTimeFormat) :void
    {
        $this->dateTimeFormat = $dateTimeFormat;
    }

    /**
     * @return DateTimeFormat
     */
    public function getDateTimeFormat() :DateTimeFormat
    {
        return $this->dateTimeFormat;
    }

    public function string():string
    {
        return $this->dateTime->format($this->getDateTimeFormat()->getName());
    }

    /**
     * 调用此函数会影响dateTime保存的时间戳
     * 0 当前月 -1 上一月 1 下一月
     * @param int $pointer
     * @throws Exception
     * @return string
     */
    public function getOneMonthFirstDay(int $pointer = 0):string
    {
        $dateTime = $this->dateTime;
        if ($pointer !== 0) {
            $isAdd = $pointer > 0 ? true : false;
            $dateInterval = new DateInterval('P'.abs($pointer).'M');

            $isAdd ? $dateTime->add($dateInterval) : $dateTime->sub($dateInterval);
        }

        return $dateTime->format($this->getDateTimeFormat()->getFirstMonthDayName());
    }

    /**
     * 调用此函数会影响dateTime保存的时间戳
     * @param int $day
     * @return string
     * @throws Exception
     */
    public function addDay(int $day):string
    {
        $dateTime = $this->dateTime;
        if ($day !== 0) {
            $isAdd = $day > 0 ? true : false;
            $dateInterval = new DateInterval('P'.abs($day).'D');

            $isAdd ? $dateTime->add($dateInterval) : $dateTime->sub($dateInterval);
        }

        return $dateTime->format($this->getDateTimeFormat()->getFirstMonthDayName());
    }

    public function __destruct()
    {
    }

    public static function getDefault():self
    {
        return new SimpleDate(DateTimezoneFactory::getDateTimezone(DateTimezoneFactory::ASIA_SHANGHAI), DateTimeFormatFactory::getDateTimeFormat(DateTimeFormat::MYSQL_DATETIME_FORMAT));

    }
}