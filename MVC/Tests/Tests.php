<?php
declare(strict_types=1);

namespace MVC\Tests;

include '../Model/Model.php';
include '../Model/Canvas.php';
include '../Model/Harmonic.php';
include '../Model/HarmonicType.php';
include '../View/ChartDrawerView.php';
include '../View/AddNewHarmonicView.php';
include '../Controller/Controller.php';

use MVC\Model\Harmonic;
use MVC\Model\HarmonicType;
use MVC\Model\Model;
use PHPUnit\Framework\TestCase;

class Tests extends TestCase
{
    public function testAddHarmonic(): void
    {
        $model = new Model();
        $harmonics = [
            new Harmonic(3,  HarmonicType::SIN, -3, 0.3)
        ];

        $model->setHarmonics($harmonics);

        $this->assertEquals(true, $model->getHarmonics() === $harmonics);
    }

    public function testChangeHarmonic(): void
    {
        $this->clear();
        $model = new Model();
        $harmonics = [
            new Harmonic(3,  HarmonicType::SIN, -3, 0.3)
        ];

        $model->setHarmonics($harmonics);
        $model->changeHarmonic(0, 'amplitude', '5');
        $model->changeHarmonic(0, 'harmonic_type', 'cos');
        $model->changeHarmonic(0, 'frequency', '1');
        $model->changeHarmonic(0, 'phase', '0.7');

        $rightHarmonic = new Harmonic(5,  HarmonicType::COS, 1, 0.7);

        $this->assertEquals(true, $model->getHarmonics()[0] == $rightHarmonic);
    }

    public function testAddNewHarmonic(): void
    {
        $this->clear();
        $model = new Model();
        $model->addNewHarmonic('5', 'sin', '-5', '-1.11');

        $rightHarmonic = new Harmonic(5,  HarmonicType::SIN, -5, -1.11);

        $this->assertEquals(true, $model->getHarmonics()[0] == $rightHarmonic);
    }

    public function testDeleteHarmonic(): void
    {
        $this->clear();
        $model = new Model();
        $harmonics = [
            new Harmonic(3,  HarmonicType::SIN, -3, 0.3)
        ];

        $model->setHarmonics($harmonics);
        $model->deleteHarmonic(0);

        $this->assertEquals(true, count($model->getHarmonics()) == 0);
    }

    public function testGetNewHarmonic(): void
    {
        $this->clear();

        $model = new Model();
        $harmonic = $model->getNewHarmonic('5', 'sin', '-5', '-1.11');

        $rightHarmonic = new Harmonic(5,  HarmonicType::SIN, -5, -1.11);

        $this->assertEquals(true, $harmonic == $rightHarmonic);
    }

    private function clear()
    {
        if (file_exists('data.txt'))
        {
            unlink('data.txt');
        }
    }
}