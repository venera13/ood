<?php
declare(strict_types=1);

class RedTea extends Tea
{
    public function getTeaType(): string
    {
        return TeaTypes::RED;
    }
}