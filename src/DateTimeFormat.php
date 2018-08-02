<?php
namespace he\date;

class DateTimeFormat
{
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';

    const YM_FORMAT = 'Y-m';

    const Y_FORMAT = 'Y';

    const YMD_FORMAT = 'Y-m-d';

    const HIS_FORMAT = 'H:i:s';

    const HI_FORMAT = 'H:i';

    const H_FORMAT = 'H';

    protected $name = '';

    public function __construct(string $formatName)
    {
        $this->setName($formatName);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $formatName)
    {
        $this->name = $formatName;
    }

    public function getFirstMonthDayName() :string
    {
        return strtr($this->getName(), [
            'd' => '01',
            'H:i:s' => '00:00:00',
            'h:i:s' => '00:00:00',
        ]);
    }
}