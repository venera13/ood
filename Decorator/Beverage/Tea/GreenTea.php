<?php
declare(strict_types=1);

class GreenTea extends Tea
{
    protected function getTeaType(): string
    {
        return TeaTypes::GREEN;
    }
}