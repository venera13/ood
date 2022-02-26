<?php

namespace Strategy\SimUDuckFunc\Duck;

class RubberDuck extends Duck
{
    public function __construct()
    {
        $this->swim();
        $this->quack('squeak');
        $this->fly('flyNoWay');
        $this->dance('noDance');
        print_r('-----------<br />');
    }
}