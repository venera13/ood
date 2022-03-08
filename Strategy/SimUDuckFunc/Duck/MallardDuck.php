<?php

namespace Strategy\SimUDuckFunc\Duck;

class MallardDuck extends Duck
{
    public function __construct()
    {
        $this->swim();
        $this->quack('quack');
        $fly = makeFlyWithWings();
        $this->fly($fly);
        $this->fly($fly);
        $this->fly($fly);
        $this->dance('danceWaltz');
        print_r('-----------<br />');
    }
}