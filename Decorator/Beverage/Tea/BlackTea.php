<?php
declare(strict_types=1);

class BlackTea extends Tea
{
    public function getTeaType(): string
    {
        return TeaTypes::BLACK;
    }
}