<?php

namespace Strategy\SimUDuckFunc\Duck;

class RedheadDuck extends Duck
{
    public function __construct()
    {
        $this->swim();
        $this->quack('quack');
        $this->quack('squeak');
        $fly = fly();
        $this->fly($fly);
        $this->dance('danceMinuet');
        print_r('-----------<br />');
    }
}