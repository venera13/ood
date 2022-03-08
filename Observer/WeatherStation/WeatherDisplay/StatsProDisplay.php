<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsProDisplay implements ObserverInterface
{
    /** @var StatsCalculator */
    private $temperatureStats;
    /** @var StatsCalculator */
    private $humidityStats;
    /** @var StatsCalculator */
    private $pressureStats;
    /** @var StatsCalculator */
    private $windSpeedStats;
    /** @var StatsWindDirectionCalculator */
    private $windDirectionStats;

    public function __construct()
    {
        $this->temperatureStats = new StatsCalculator();
        $this->humidityStats = new StatsCalculator();
        $this->pressureStats = new StatsCalculator();
        $this->windSpeedStats = new StatsCalculator();
        $this->windDirectionStats = new StatsWindDirectionCalculator();
    }

    public function update(mixed $subject): void
    {
        $data = $subject->getChangedData();

        $subjectType = $subject instanceof WeatherDataInside ? 'Inside' : 'Outside';
        print_r('Observable type ' . $subjectType . '</br>');

        $this->updateStatistics($data);
        $this->printStatistics();
    }

    private function updateStatistics($observableData): void
    {
        $this->temperatureStats->update($observableData->getTemperature());
        $this->humidityStats->update($observableData->getHumidity());
        $this->pressureStats->update($observableData->getPressure());
        $this->windSpeedStats->update($observableData->getWindSpeed());
        $this->windDirectionStats->update($observableData->getWindDirection());
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
        if (method_exists($stats, 'getMinValue')) print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        if (method_exists($stats, 'getMaxValue')) print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        if (method_exists($stats, 'getAverage')) print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }
}