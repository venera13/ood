<?php
declare(strict_types=1);

namespace MVC\Model;

class Model
{
    public function getChart(): void
    {
        $canvas = new Canvas();
        $canvas->drawChart();
    }
}