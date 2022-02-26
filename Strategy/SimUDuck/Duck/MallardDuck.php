<?php

class MallardDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(
            new Quack(),
            new FlyWithWings(),
            new DanceWaltz()
        );
    }

    public function setQuack(IQuackBehavior $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function setFly(IFlyBehavior $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setDance(IDanceBehavior $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior;
    }
}