<?php
declare(strict_types=1);

namespace MVC;

include 'Model.php';
include 'View.php';
include 'Controller.php';

$model = new Model();
$view = new View();
$controller = new Controller($model, $view);

if (isset($_GET['action']) && !empty($_GET['action']))
{
    $controller->{$_GET['action']}();
}
$controller->response();