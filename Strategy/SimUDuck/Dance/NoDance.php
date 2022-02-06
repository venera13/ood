<?php

class NoDance implements IDanceBehavior
{
    public function dance()
    {
        print_r('No dance');
    }
}