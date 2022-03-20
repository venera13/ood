<?php
declare(strict_types=1);

class WhiteTea extends Tea
{
    protected function getTeaType(): string
    {
        return TeaTypes::WHITE;
    }
}