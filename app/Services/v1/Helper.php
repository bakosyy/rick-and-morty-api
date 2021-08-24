<?php

namespace App\Services\v1;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Helper
{
    public static function isEmptyString($string)
    {
        if ($string == null) {
            return true;
        }
        return Str::of($string)->trim()->isEmpty();
    }

    public static function isNotEmptyString($string)
    {
        if ($string == null) {
            return false;
        }
        return Str::of($string)->trim()->isNotEmpty();
    }

    public static function getLength($string)
    {
        return Str::of($string)->length();
    }
    
    public static function isNotEmptyArray($array)
    {
        if ($array == null) {
            return false;
        }

        $value = data_get($array, 0);
        if (static::getLength($value) > 0) {
            return true;
        }
        return false;
    }
}