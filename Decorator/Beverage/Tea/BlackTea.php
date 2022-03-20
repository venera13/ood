<?php
declare(strict_types=1);

class BlackTea extends Tea
{
    protected function getTeaType(): string
    {
        return TeaTypes::BLACK;
    }
}