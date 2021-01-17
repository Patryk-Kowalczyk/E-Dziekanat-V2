<?php

namespace App\Http\Traits;

trait dateFormatTrait
{
    public static function format_Ymd_Hi($date)
    {
        return $date->format('Y-m-d H:i');
    }

}
