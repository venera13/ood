<?php

namespace Strategy\SimUDuckFunc\Fly;

class FlyWithWings
{
    /** @var int */
    private $flightsCount = 0;

    public function fly(): callable
    {
        return function()
        {
            $this->flightsCount++;
            print_r('Fly with wings. Flight number ' . $this->flightsCount);
        };
    }
}