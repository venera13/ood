<?php
declare(strict_types=1);

namespace MVC;

class View
{
    public function render(array $params): void
    {
        include('templates/chart_drawer.php');
    }
}