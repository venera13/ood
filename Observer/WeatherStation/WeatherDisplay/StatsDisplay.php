<?php
declare(strict_types=1);

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

    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        if ($observableType)
        {
            print_r('Observable type ' . $observableType . '</br>');
        }

        $this->updateStatistics($weatherInfo);
        $this->printStatistics();
    }

    /**
     * @param $weatherInfo
     */
    private function updateStatistics($weatherInfo): void
    {
        $this->temperatureStats->update($weatherInfo->getTemperature());
        $this->humidityStats->update($weatherInfo->getHumidity());
        $this->pressureStats->update($weatherInfo->getPressure());
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