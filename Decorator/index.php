<?php
declare(strict_types=1);

namespace Decorator;

include 'Beverage/BeverageInterface.php';
include 'Beverage/Coffee/Coffee.php';
include 'Beverage/Coffee/Latte.php';
include 'Beverage/Coffee/Сappuccino.php';
include 'Beverage/MilkShake/MilkShake.php';
include 'Beverage/Tea/Tea.php';
include 'Beverage/Tea/BlackTea.php';
include 'CondimentDecorator/CondimentDecorator.php';
include 'CondimentDecorator/ChocolateCrumbs.php';
include 'CondimentDecorator/ChocolateSyrup.php';
include 'CondimentDecorator/Cinnamon.php';
include 'CondimentDecorator/CoconutFlakes.php';
include 'CondimentDecorator/Ice.php';
include 'CondimentDecorator/Lemon.php';
include 'CondimentDecorator/Сream.php';
include 'CondimentDecorator/Chocolate.php';
include 'CondimentDecorator/Liquor.php';
include 'Domain/CoffeePortionTypes.php';
include 'Domain/TeaTypes.php';
include 'Domain/MilkShakePortionTypes.php';
include 'Domain/LiquorType.php';

use Decorator\CondimentDecorator\Liquor;
use Decorator\Domain\CoffeePortionTypes;
use Decorator\Domain\LiquorType;
use Decorator\CondimentDecorator\Chocolate;
use Decorator\CondimentDecorator\Сream;
use Decorator\Beverage\Tea\BlackTea;
use Decorator\Beverage\Coffee\Latte;
use Decorator\Beverage\Coffee\Сappuccino;
use Decorator\Beverage\Milkshake\MilkShake;
use Decorator\CondimentDecorator\Cinnamon;
use Decorator\CondimentDecorator\Lemon;
use Decorator\CondimentDecorator\ChocolateCrumbs;
use Decorator\CondimentDecorator\CoconutFlakes;

$latte = new Latte(CoffeePortionTypes::STANDARD);
$cinnamon = new Cinnamon($latte);
print_r($cinnamon->getDescription() . '</br>');
print_r($cinnamon->getCost() . '</br>');

$сappuccino = new Сappuccino(CoffeePortionTypes::DOUBLE);
$chocolateCrumbs = new ChocolateCrumbs($сappuccino);
print_r($chocolateCrumbs->getDescription() . '</br>');
print_r($chocolateCrumbs->getCost() . '</br>');

$сappuccino = new Сappuccino(CoffeePortionTypes::DOUBLE);
$cream = new Сream($сappuccino);
print_r($cream->getDescription() . '</br>');
print_r($cream->getCost() . '</br>');

$blackTea = new BlackTea();
$lemon = new Lemon($blackTea, 2);
print_r($lemon->getDescription() . '</br>');
print_r($lemon->getCost() . '</br>');

$milkShake = new MilkShake();
$coconutFlakes = new CoconutFlakes($milkShake);
print_r($coconutFlakes->getDescription() . '</br>');
print_r($coconutFlakes->getCost() . '</br>');

$milkShake = new MilkShake();
$chocolate = new Chocolate($milkShake, 6);
print_r($chocolate->getDescription() . '</br>');
print_r($chocolate->getCost() . '</br>');

$milkShake = new MilkShake();
$liquor = new Liquor($milkShake, LiquorType::CHOCOLATE);
print_r($liquor->getDescription() . '</br>');
print_r($liquor->getCost() . '</br>');