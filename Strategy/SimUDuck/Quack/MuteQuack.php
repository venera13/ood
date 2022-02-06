<?php

class MuteQuack implements IQuackBehavior
{
    public function quack(): void
    {
        print_r('Mute quack');
    }
}