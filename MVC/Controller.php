<?php
declare(strict_types=1);

namespace MVC;

class Controller
{
    /** @var Model */
    private $model;
    /** @var View */
    private $view;

    public function __construct(Model $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function response(): void
    {
        $functions = $this->getFunctions();
        $params = [
            'functions' => $functions
        ];

        $this->view->render($params);
    }

    public function getChart(): void
    {
        $this->model->getChart();
    }

    public function getFunctions(): array
    {
        return [
            '3*sin(-3*x+0.3)',
            '3*sin(-3*x+0.3)',
            '3*sin(-3*x+0.3)',
            '3*sin(-3*x+0.3)'
        ];
    }
}