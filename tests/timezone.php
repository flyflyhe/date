<?php

function d()
{
    #作用于调用后的整个脚本
    date_default_timezone_set('UTC');
}

echo date('Y-m-d H:i:s').PHP_EOL;
d();
echo date('Y-m-d H:i:s').PHP_EOL;
$timezone = new DateTimeZone("Asia/Shanghai");
echo $timezone->getName();
