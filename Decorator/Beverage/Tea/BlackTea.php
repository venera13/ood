<?php
declare(strict_types=1);

namespace Decorator\Beverage\Tea;

use Decorator\Domain\TeaTypes;

class BlackTea extends Tea
{
    public function getTeaType(): string
    {
        return TeaTypes::BLACK;
    }
}