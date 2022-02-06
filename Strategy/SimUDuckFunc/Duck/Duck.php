<?php

namespace Strategy\SimUDuckFunc\Duck;

class Duck
{
    public function swim(): void
    {
        // Duck swims
    }

    public function quack(callable $callable): callable
    {
        return $callable;
    }

    public function fly(callable $callable): callable
    {
        return $callable;
    }

    public function dance(callable $callable): callable
    {
        return $callable;
    }
}