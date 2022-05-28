<?php
declare(strict_types=1);

namespace MVC\Model;

class Model
{
    public function getChart(): void
    {
        $canvas = new Canvas();
        $x[0]=1; $y[0]=1;
        $x[1]=2; $y[1]=4;
        $x[2]=3; $y[2]=8;
        $x[3]=4; $y[3]=-2;
        $data = [
            'x' => [1, 2, 3, 4],
            'y' => [1, 4, 8, -2]
        ];
        $canvas->drawChart($data);
    }
}