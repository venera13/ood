<?php

namespace Strategy\SimUDuckFunc\Duck;

class Duck
{
    public function swim(): void
    {
        print_r('Swim <br/>');
    }

    public function quack(callable $callable): void
    {
        $callable();
    }

    public function fly(callable $callable): void
    {
        $callable();
    }

    public function dance(callable $callable): void
    {
        $callable();
    }
}