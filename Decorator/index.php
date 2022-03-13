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
include 'CondimentDecorator/Condiment.php';

use Decorator\Beverage\BeverageInterface;
use Decorator\CondimentDecorator\Condiment;
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
$cinnamon = Condiment::makeCondiment('Cinnamon');
printInfo($cinnamon($latte));

$сappuccino = new Сappuccino(CoffeePortionTypes::DOUBLE);
$chocolateCrumbs = Condiment::makeCondiment('ChocolateCrumbs');
printInfo($chocolateCrumbs($сappuccino));

$сappuccino = new Сappuccino(CoffeePortionTypes::DOUBLE);
$cream = Condiment::makeCondiment('Сream');
printInfo($cream($сappuccino));

$blackTea = new BlackTea();
$lemon2 = Condiment::makeCondiment('Lemon', 2);
printInfo($lemon2($blackTea));

$milkShake = new MilkShake();
$coconutFlakes = Condiment::makeCondiment('CoconutFlakes');
$liquor = Condiment::makeCondiment('Liquor', LiquorType::CHOCOLATE);
printInfo($liquor($coconutFlakes($milkShake)));

$milkShake = new MilkShake();
$chocolate = Condiment::makeCondiment('Chocolate', 6);
printInfo($chocolate($milkShake));

function printInfo(BeverageInterface $beverage): void
{
    print_r($beverage->getDescription() . '</br>');
    print_r('Cost - ' . $beverage->getCost() . '</br>');
    print_r('------------------</br></br>');
}