<?php
declare(strict_types=1);

namespace MVC;

include 'Model/Model.php';
include 'Model/Canvas.php';
include 'Model/pChart.php';
include 'View/View.php';
include 'Controller/Controller.php';

use MVC\Model\Model;
use MVC\View\View;
use MVC\Controller\Controller;

$model = new Model();
$view = new View();
$controller = new Controller($model, $view);

if (isset($_GET['action']) && !empty($_GET['action']))
{
    $controller->{$_GET['action']}();
}
$controller->response();