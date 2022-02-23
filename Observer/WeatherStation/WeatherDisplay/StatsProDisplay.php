<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsProDisplay implements ObserverInterface
{
    /** @var StatsCalculatorInterface */
    private $temperatureStats;
    /** @var StatsCalculatorInterface */
    private $humidityStats;
    /** @var StatsCalculatorInterface */
    private $pressureStats;
    /** @var StatsCalculatorInterface */
    private $windSpeedStats;
    /** @var StatsCalculatorInterface */
    private $windDirectionStats;

    public function __construct()
    {
        $this->temperatureStats = new StatsCalculator();
        $this->humidityStats = new StatsCalculator();
        $this->pressureStats = new StatsCalculator();
        $this->windSpeedStats = new StatsCalculator();
        $this->windDirectionStats = new StatsWindDirectionCalculator();
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

    private function updateStatistics($weatherInfo): void
    {
        $this->temperatureStats->update($weatherInfo->getTemperature());
        $this->humidityStats->update($weatherInfo->getHumidity());
        $this->pressureStats->update($weatherInfo->getPressure());
        $this->windSpeedStats->update($weatherInfo->getWindSpeed());
        $this->windDirectionStats->update($weatherInfo->getWindDirection());
    }

    private function printStatistics(): void
    {
        $this->printStatistic('Temperature', $this->temperatureStats);
        $this->printStatistic('Humidity', $this->humidityStats);
        $this->printStatistic('Pressure', $this->pressureStats);
        $this->printStatistic('Wind speed', $this->windSpeedStats);
        $this->printStatistic('Wind direction', $this->windDirectionStats);
    }

    /**
     * @param string $paramName
     * @param T $stats
     */
    private function printStatistic(string $paramName, mixed $stats): void
    {
        print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }
}