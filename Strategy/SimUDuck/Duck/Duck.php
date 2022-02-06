<?php

class Duck
{
    /** @var IQuackBehavior */
    private $quackBehavior;
    /** @var IFlyBehavior */
    private $flyBehavior;
    /** @var IDanceBehavior */
    private $danceBehavior;

    public function __construct(
        IQuackBehavior $quackBehavior,
        IFlyBehavior $flyBehavior,
        IDanceBehavior $danceBehavior
    ) {
        $this->quackBehavior = $quackBehavior;
        $this->flyBehavior = $flyBehavior;
        $this->danceBehavior = $danceBehavior;
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

    public function swim(): void
    {
        // Duck swims
    }

    public function quack(): void
    {
        $this->quackBehavior->quack();
    }

    public function fly(): void
    {
        $this->flyBehavior->fly();
    }

    public function dance(): void
    {
        $this->danceBehavior->dance();
    }
}