<?php
namespace he\date;

use DateTime;
use DateTimeZone;
use DateInterval;
use Exception;

class FuncDate
{
    protected  $defaultTimezone;

    public function __construct(string $timezone = '')
    {
        if ($timezone !== '') {
            $this->defaultTimezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
        }
    }

    public function __destruct()
    {
        if ($this->defaultTimezone) {
            date_default_timezone_set($this->defaultTimezone);
        }
    }

    public  function getMicroTime():float
    {
        list($uSec, $sec) = explode(" ", microtime());
        return ((float)$uSec + (float)$sec);
    }

    /**
     *获取以前据当前天时间的凌晨时间或最晚时间的mysql datetime格式
     * @before 距离今天的天数 eg: 1昨天
     * @morn = true 最早时间
     * @param int $before
     * @param bool $morn
     * @return string
     * @throws Exception
     */
    public function getDateBefore(int $before = 0, bool $morn = true): string
    {
        $DateTime = new \DateTime();
        $dateInterval = new \DateInterval('P'.intval($before).'D');
        $DateTime->sub($dateInterval);
        if ($morn) {
            return $DateTime->format('Y-m-d 00:00:00');
        } else {
            return $DateTime->format('Y-m-d 23:59:59');
        }
    }

    public function getDate(int $before = 0):string
    {
        $DateTime = new \DateTime();
        $dateInterval = new \DateInterval('P'.intval($before).'D');
        $DateTime->sub($dateInterval);
        return $DateTime->format('Y-m-d');
    }

    public function getDateFormat(int $before = 0, string $format = 'Y-m-d'):string
    {
        $DateTime = new \DateTime();
        $dateInterval = new \DateInterval('P'.intval($before).'D');
        $DateTime->sub($dateInterval);
        return $DateTime->format($format);
    }

    /**
     *获取以前据当前月时间的凌晨时间或最晚时间的mysql datetime格式
     * @before 距离今天的月数 eg: 1上一月
     * @morn = true 最早时间
     * @param int $before
     * @param bool $start
     * @return string
     * @throws Exception
     */
    public function getMonthDateBefore(int $before = 0, bool $start = true): string
    {
        $DateTime = new \DateTime();
        $dateInterval = new \DateInterval('P'.intval($before).'M');
        $DateTime->sub($dateInterval);
        if ($start) {
            return $DateTime->format('Y-m-01 00:00:00');
        } else {
            $months = $DateTime->format('t');
            return $DateTime->format('Y-m-'.$months.' 23:59:59');
        }
    }

    /**
     *获取以前据当前年时间的凌晨时间或最晚时间的mysql datetime格式
     * @before 距离今天的月数 eg: 1上一年
     * @morn = true 最早时间
     * @param int $before
     * @param bool $start
     * @return string
     * @throws Exception
     */
    public function getYearDateBefore(int $before = 0, bool $start = true):string
    {
        $DateTime = new \DateTime();
        $dateInterval = new \DateInterval('P'.intval($before).'Y');
        $DateTime->sub($dateInterval);
        if ($start) {
            return $DateTime->format('Y-01-01 00:00:00');
        } else {
            return $DateTime->format('Y-12-31 23:59:59');
        }
    }


    public function getMonth(string $date = '')
    {
        $date = $date ? date(DateTimeFormat::MYSQL_DATETIME_FORMAT, strtotime($date)) : date(DateTimeFormat::MYSQL_DATETIME_FORMAT);
        $start = date('Y-m-01 00:00:00', strtotime($date));
        $end = date('Y-m-'.date('t', strtotime($date)).' 23:59:59', strtotime($date));
        return [$start, $end];
    }

    public function getYear(string $date = ''): array
    {
        $date = $date ? date(DateTimeFormat::MYSQL_DATETIME_FORMAT, strtotime($date)) : date(DateTimeFormat::MYSQL_DATETIME_FORMAT);
        $start = date('Y-01-01 00:00:00', strtotime($date));
        $end = date('Y-12-31 23:59:59', strtotime($date));
        return [$start, $end];
    }

    public function getAllMonth(string $start = 'now'):array
    {
        $current = date(DateTimeFormat::MYSQL_DATETIME_FORMAT);
        $DateTime = new \DateTime($start);
        $start = date('Y-m', strtotime($start));
        $monthArr = [];
        while ($start < $current) {
            $monthArr[] = $start;
            $dateInterval = new \DateInterval('P1M');
            $DateTime->add($dateInterval);
            $start = $DateTime->format('Y-m');
        }
        return $monthArr;

    }

    public function getAllYear(string $start = 'now'):array
    {
        $current = date(DateTimeFormat::MYSQL_DATETIME_FORMAT);
        $DateTime = new \DateTime($start);
        $start = date('Y', strtotime($start));
        $yearArr = [];
        while ($start < $current) {
            $tmpArr[] = $start;
            $dateInterval = new \DateInterval('P1Y');
            $DateTime->add($dateInterval);
            $start = $DateTime->format('Y');
        }
        return $yearArr;
    }

    public function getTodayRemainSecond():int
    {
        $date = date('Y-m-d 23:59:59');

        return strtotime($date) - time();
    }
}