<?php
declare(strict_types=1);

namespace Decorator\Beverage\Tea;

use Decorator\Domain\TeaTypes;

class RedTea
{
    public function getTeaType(): string
    {
        return TeaTypes::RED;
    }
}