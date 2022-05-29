<?php
declare(strict_types=1);

namespace MVC;

include 'Model/Model.php';
include 'Model/Canvas.php';
include 'Model/Harmonic.php';
include 'Model/HarmonicType.php';
include 'View/ChartDrawerView.php';
include 'View/AddNewHarmonicView.php';
include 'Controller/Controller.php';

use MVC\Model\Model;
use MVC\View\AddNewHarmonicView;
use MVC\View\ChartDrawerView;
use MVC\Controller\Controller;

$model = new Model();
$chartDrawerView = new ChartDrawerView();
$addNewHarmonicView = new AddNewHarmonicView();
$controller = new Controller($model, $chartDrawerView, $addNewHarmonicView);

if (isset($_GET['action']) && !empty($_GET['action']))
{
    $controller->{$_GET['action']}();
}
else
{
    $controller->getResponse();
}