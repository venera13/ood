<?php

class RubberDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(
            new Squeak(),
            new FlyNoWay(),
            new NoDance()
        );
    }
}