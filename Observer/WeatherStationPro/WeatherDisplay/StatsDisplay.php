<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\WeatherData\WeatherDataInside;

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var StatsCalculator */
    private $temperatureStats;
    /** @var StatsCalculator */
    private $humidityStats;
    /** @var StatsCalculator */
    private $pressureStats;

    public function __construct()
    {
        $this->temperatureStats = new StatsCalculator();
        $this->humidityStats = new StatsCalculator();
        $this->pressureStats = new StatsCalculator();
    }

    public function update(mixed $subject): void
    {
        $data = $subject->getChangedData();

        $subjectType = $subject instanceof WeatherDataInside ? 'Inside' : 'Outside';
        print_r('Observable type ' . $subjectType . '</br>');
        print_r('----' . '</br>');

        $this->updateStatistics($data);
        $this->printStatistics();
    }

    /**
     * @param $observableData
     */
    private function updateStatistics($observableData): void
    {
        $this->temperatureStats->update($observableData->getTemperature());
        $this->humidityStats->update($observableData->getHumidity());
        $this->pressureStats->update($observableData->getPressure());
    }

    private function printStatistics(): void
    {
        $this->printStatistic('Temperature', $this->temperatureStats);
        $this->printStatistic('Humidity', $this->humidityStats);
        $this->printStatistic('Pressure', $this->pressureStats);
    }

    /**
     * @param string $paramName
     * @param StatsCalculator $stats
     */
    private function printStatistic(string $paramName, StatsCalculator $stats): void
    {
        print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }
}