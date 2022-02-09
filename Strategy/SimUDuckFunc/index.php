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
use Strategy\SimUDuckFunc\Fly\FlyWithWings;

$mallardDuck = new MallardDuck();
$mallardDuck->swim();
$mallardDuck->quack('quack');
$flyWithWings = new FlyWithWings();
$mallardDuck->fly($flyWithWings->fly());
$mallardDuck->fly($flyWithWings->fly());
$mallardDuck->dance('danceWaltz');

$mallardDuck = new RedheadDuck();
$mallardDuck->swim();
$mallardDuck->quack('quack');
$mallardDuck->quack('squeak');
$flyWithWings = new FlyWithWings();
$mallardDuck->fly($flyWithWings->fly());
$mallardDuck->dance('danceMinuet');

$mallardDuck = new RubberDuck();
$mallardDuck->swim();
$mallardDuck->quack('squeak');
$mallardDuck->fly('flyNoWay');
$mallardDuck->dance('noDance');

$mallardDuck = new DecoyDuck();
$mallardDuck->swim();
$mallardDuck->quack('muteQuack');
$mallardDuck->fly('flyNoWay');
$flyWithWings = new FlyWithWings();
$mallardDuck->fly($flyWithWings->fly());
$mallardDuck->fly($flyWithWings->fly());
$mallardDuck->dance('noDance');