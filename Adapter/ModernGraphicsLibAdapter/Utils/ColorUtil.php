<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLibAdapter\Utils;

class ColorUtil
{
    public static function hex2RGB(int $rgbColor): array
    {
        $rgbArray = [];

        $rgbArray[] = 0xFF & ($rgbColor >> 0x10);
        $rgbArray[] = 0xFF & ($rgbColor >> 0x8);
        $rgbArray[] = 0xFF & $rgbColor;

        return $rgbArray;
    }
}