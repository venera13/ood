<?php

class FlyWithWings implements IFlyBehavior
{
    /** @var int */
    private $flightsCount = 0;

    public function fly(): void
    {
        $this->flightsCount++;
        print_r('Fly with wings. Flight number ' . $this->flightsCount . '<br/>');
    }
}