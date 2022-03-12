<?php
declare(strict_types=1);

class Arrays
{
    public static function removeNulls(array $array): array
    {
        return array_filter($array, static function ($value)
        {
            return $value !== null;
        });
    }
}