<?php

class Quack implements IQuackBehavior
{
    public function quack(): void
    {
        print_r('Quack <br/>');
    }
}