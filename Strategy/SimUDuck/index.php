<?php

include 'Duck/Duck.php';
include 'Duck/MallardDuck.php';
include 'Duck/RedheadDuck.php';
include 'Duck/RubberDuck.php';
include 'Duck/DecoyDuck.php';
include 'Quack/IQuackBehavior.php';
include 'Quack/Quack.php';
include 'Quack/MuteQuack.php';
include 'Quack/Squeak.php';
include 'Fly/IFlyBehavior.php';
include 'Fly/FlyWithWings.php';
include 'Fly/FlyNoWay.php';
include 'Dance/IDanceBehavior.php';
include 'Dance/DanceWaltz.php';
include 'Dance/DanceMinuet.php';
include 'Dance/NoDance.php';

$mallardDuck = new MallardDuck(
    new Quack(),
    new FlyWithWings(),
    new DanceWaltz()
);
$mallardDuck->quack();
$mallardDuck->fly();
$mallardDuck->fly();
$mallardDuck->dance();
$mallardDuck->setFly(new FlyNoWay());
$mallardDuck->fly();
$mallardDuck->fly();

$redheadDuck = new RedheadDuck(
    new Quack(),
    new FlyWithWings(),
    new DanceMinuet()
);
$redheadDuck->quack();
$redheadDuck->setFly(new FlyNoWay);
$redheadDuck->fly();
$redheadDuck->dance();
$redheadDuck->setDance(new DanceWaltz());
$redheadDuck->dance();

$rubberDuck = new RubberDuck(
    new Squeak(),
    new FlyNoWay(),
    new NoDance()
);
$rubberDuck->quack();
$rubberDuck->setQuack(new Quack());
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
