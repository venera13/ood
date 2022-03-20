<?php
declare(strict_types=1);

class RedTea extends Tea
{
    protected function getTeaType(): string
    {
        return TeaTypes::RED;
    }
}