<?php


namespace App\Http\Traits;


class DaysFormatTrait
{
    public static function weekFormat($from,$to)
    {
        $days = [];
        $stepVal = '+1 day';
        $current = strtotime($from);
        $last = strtotime($to);
        while ($current <= $last) {
            $days[] = date('Y-m-d', $current);
            $current = strtotime($stepVal, $current);
        }
        return $days;
    }

}
