<?php
declare(strict_types=1);

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
include 'CondimentDecorator/IceCube.php';
include 'CondimentDecorator/Lemon.php';
include 'CondimentDecorator/Сream.php';
include 'CondimentDecorator/Chocolate.php';
include 'CondimentDecorator/Liquor.php';
include 'Domain/CoffeePortionType.php';
include 'Domain/TeaTypes.php';
include 'Domain/MilkShakePortionType.php';
include 'Domain/LiquorType.php';
include 'Domain/IceCubeType.php';
include 'CondimentDecorator/Condiment.php';

$latte = new Latte(CoffeePortionType::STANDARD);
$cinnamon = Condiment::makeCondiment('Cinnamon');
printInfo($cinnamon($latte));

$сappuccino = new Сappuccino(CoffeePortionType::DOUBLE);
$chocolateCrumbs = Condiment::makeCondiment('ChocolateCrumbs');
printInfo($chocolateCrumbs($сappuccino));

$сappuccino = new Сappuccino(CoffeePortionType::DOUBLE);
$cream = Condiment::makeCondiment('Сream');
printInfo($cream($сappuccino));

$blackTea = new BlackTea();
$lemon2 = Condiment::makeCondiment('Lemon', 2);
$iceCube = Condiment::makeCondiment('IceCube', 2, IceCubeType::DRY);
printInfo($iceCube($lemon2($blackTea)));

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