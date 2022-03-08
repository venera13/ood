<?php
declare(strict_types=1);

function makeFlyWithWings(): callable
{
    $flightCount = 0;
    return function() use (&$flightCount)
    {
        $flightCount += 1;
        print_r('Fly with wings. Flight number ' . $flightCount . '<br/>');
    };
}