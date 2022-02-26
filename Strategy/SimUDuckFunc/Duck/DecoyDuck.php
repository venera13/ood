<?php

namespace Strategy\SimUDuckFunc\Duck;

class DecoyDuck extends Duck
{
    public function __construct()
    {
        $this->swim();
        $this->quack('muteQuack');
        $this->fly('flyNoWay');
        $this->dance('noDance');
        print_r('-----------<br />');
    }
}