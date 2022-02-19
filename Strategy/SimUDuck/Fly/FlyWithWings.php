<?php

class FlyWithWings implements IFlyBehavior
{
    /** @var int */
    private $flightCount = 0;

    public function fly(): void
    {
        $this->flightCount++;
        print_r('Fly with wings. Flight number ' . $this->flightCount . '<br/>');
    }
}