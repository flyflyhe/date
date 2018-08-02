<?php

function d()
{
    #作用于调用后的整个脚本
    date_default_timezone_set('UTC');
    echo date('Y-m-d H:i:s').PHP_EOL;
}

echo date('Y-m-d H:i:s');
d();
