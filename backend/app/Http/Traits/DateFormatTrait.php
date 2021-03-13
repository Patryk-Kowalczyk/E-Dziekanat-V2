<?php

namespace App\Http\Traits;

trait DateFormatTrait
{
    public static function format_Ymd_Hi($date)
    {
        return $date->format('Y-m-d H:i');
    }
    public static function format_Ymd($date)
    {
        return $date->format('Y-m-d');
    }
}
