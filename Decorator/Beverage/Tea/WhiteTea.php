<?php
declare(strict_types=1);

class WhiteTea extends Tea
{
    public function getTeaType(): string
    {
        return TeaTypes::WHITE;
    }
}