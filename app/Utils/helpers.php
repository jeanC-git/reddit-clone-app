<?php

use Carbon\Carbon;

function carbonFromFormat($date, $format = 'Y-m-d H:i:s')
{
    return Carbon::createFromFormat($format, $date);
}
