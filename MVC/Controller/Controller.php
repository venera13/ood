<?php
declare(strict_types=1);

namespace MVC\Controller;

use MVC\Model\Harmonic;
use MVC\Model\HarmonicType;
use MVC\Model\Model;
use MVC\View\AddNewHarmonicView;
use MVC\View\ChartDrawerView;

class Controller
{
    /** @var Model */
    private $model;
    /** @var ChartDrawerView */
    private $chartDrawerView;
    /** @var AddNewHarmonicView */
    private $addNewHarmonicView;

    public function __construct(Model $model, ChartDrawerView $chartDrawerView, AddNewHarmonicView $addNewHarmonicView)
    {
        $this->model = $model;
        $this->chartDrawerView = $chartDrawerView;
        $this->addNewHarmonicView = $addNewHarmonicView;

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

        $this->chartDrawerView->render($params);
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

    public function addNew(): void
    {
        $harmonic = $this->model->getNewHarmonic(
            $_GET['amplitude'] ?? null,
            $_GET['harmonic_type'] ?? null,
            $_GET['frequency'] ?? null,
            $_GET['phase'] ?? null
        );
        $this->addNewHarmonicView->render($harmonic);
    }

    public function addNewHarmonic(): void
    {
        $this->model->addNewHarmonic(
            $_GET['amplitude'] ?? null,
            $_GET['harmonic_type'] ?? null,
            $_GET['frequency'] ?? null,
            $_GET['phase'] ?? null
        );
        $this->getResponse();
    }

    public function addNewHarmonicCancel(): void
    {
        $this->getResponse();
    }

    public function deleteSelected(): void
    {
        $this->model->deleteHarmonic(intval($_GET['index']));
        $this->getResponse();
    }
}