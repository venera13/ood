<?php

class Squeak implements IQuackBehavior
{
    public function quack(): void
    {
        print_r('Squeak <br/>');
    }
}