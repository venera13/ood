<?php

$mallardDuck = new MallardDuck(
    new Quack(),
    new FlyWithWings(),
    new DanceWaltz()
);
$mallardDuck->quack();
$mallardDuck->fly();
$mallardDuck->dance();

$redheadDuck = new RedheadDuck(
    new Quack(),
    new FlyWithWings(),
    new DanceMinuet()
);
$redheadDuck->quack();
$redheadDuck->setFly(new FlyNoWay);
$redheadDuck->fly();
$redheadDuck->dance();

$rubberDuck = new RubberDuck(
    new Squeak(),
    new FlyNoWay(),
    new NoDance()
);
$rubberDuck->quack();
$rubberDuck->fly();
$rubberDuck->dance();

$rubberDuck = new DecoyDuck(
    new MuteQuack(),
    new FlyNoWay(),
    new NoDance()
);
$rubberDuck->quack();
$rubberDuck->fly();
$rubberDuck->dance();
