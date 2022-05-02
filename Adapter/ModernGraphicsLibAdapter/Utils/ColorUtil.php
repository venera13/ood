<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLibAdapter\Utils;

class ColorUtil
{
    public static function hex2RGB(int $hex): array
    {
        $rgbArray = [];

        $rgbArray[] = 0xFF & ($hex >> 0x10);
        $rgbArray[] = 0xFF & ($hex >> 0x8);
        $rgbArray[] = 0xFF & $hex;

        return $rgbArray;
    }
}