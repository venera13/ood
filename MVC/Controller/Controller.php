<?php
declare(strict_types=1);

namespace MVC\Controller;

use MVC\Model\Harmonic;
use MVC\Model\HarmonicType;
use MVC\Model\Model;
use MVC\View\View;

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

//        $harmonics = [
//            new Harmonic(3,  HarmonicType::SIN, -3, 0.3),
//            new Harmonic(4.38,  HarmonicType::SIN, 2.25, 1.5),
//        ];
//
//        $this->model->setHarmonics($harmonics);
    }

    public function getResponse(?array $params = null): void
    {
        $params = $params ?? [];
        $params['harmonics'] = $this->model->getHarmonics();

        $this->view->render($params);
    }

    public function getChart(): void
    {
        $this->model->getChart();
    }

    public function changeHarmonic(): void
    {
        $this->model->changeHarmonic(intval($_GET['index']), $_GET['key'], $_GET['value']);
        $params = [
            'active' => intval($_GET['index'])
        ];
        $this->getResponse($params);
    }

    public function switchHarmonic(): void
    {
        $params = [
            'active' => intval($_GET['index'])
        ];
        $this->getResponse($params);
    }

    public function deleteSelected(): void
    {
        $this->model->deleteHarmonic(intval($_GET['index']));
        $this->getResponse();
    }
}