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
//        call_user_func($callable);
//        print_r($callable());
//        print_r('<br />');
        $callable();
    }

    public function dance(callable $callable): void
    {
        $callable();
    }
}