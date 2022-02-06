<?php

class FlyNoWay implements IFlyBehavior
{
    public function fly(): void
    {
        print_r('Fly no way');
    }
}