<?php
declare(strict_types=1);

class GreenTea extends Tea
{
    public function getTeaType(): string
    {
        return TeaTypes::GREEN;
    }
}