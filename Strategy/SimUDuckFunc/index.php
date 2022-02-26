<?php

namespace Strategy\SimUDuckFunc;

include 'Duck/Duck.php';
include 'Duck/MallardDuck.php';
include 'Duck/RedheadDuck.php';
include 'Duck/RubberDuck.php';
include 'Duck/DecoyDuck.php';
include 'Dance/Dance.php';
include 'Fly/Fly.php';
include 'Fly/FlyWithWings.php';
include 'Quack/Quack.php';

use Strategy\SimUDuckFunc\Duck\DecoyDuck;
use Strategy\SimUDuckFunc\Duck\MallardDuck;
use Strategy\SimUDuckFunc\Duck\RedheadDuck;
use Strategy\SimUDuckFunc\Duck\RubberDuck;

new MallardDuck();
new RedheadDuck();
new RubberDuck();
new DecoyDuck();