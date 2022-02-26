<?php

class DecoyDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(
            new MuteQuack(),
            new FlyNoWay(),
            new NoDance()
        );
    }
}