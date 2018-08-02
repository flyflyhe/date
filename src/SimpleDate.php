<?php
namespace he\date;

use DateTime;
use DateTimeZone;
use DateInterval;

class SimpleDate
{
    protected $dateTimezone = null;

    protected $dateTimeFormat = null;

    /**
     * SimpleDate constructor.
     * @param DateTimeZone $dateTimeZone
     * @param DateTimeFormat $dateTimeFormat
     */
    public function __construct(DateTimeZone $dateTimeZone, DateTimeFormat $dateTimeFormat)
    {
        $this->setDateTimezone($dateTimeZone);
        $this->setDateTimeFormat($dateTimeFormat);
    }

    /**
     * @param DateTimeZone $dateTimeZone
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

    /**
     * 0 当前月 -1 上一月 1 下一月
     * @param int $pointer
     * @throws \Exception
     * @return string
     */
    public function getOneMonthFirstDay(int $pointer = 0)
    {
        $dateTime = new DateTime();
        if ($pointer !== 0) {
            $is_add = $pointer > 0 ? true : false;
            $dateInterval = new DateInterval('P'.abs($pointer).'M');

            $is_add ? $dateTime->add($dateInterval) : $dateTime->sub($dateInterval);
        }

        return $dateTime->format($this->getDateTimeFormat()->getFirstMonthDayName());
    }
}