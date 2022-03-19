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

    public function update(ObservableInterface $subject): void
    {
        $data = $subject->getChangedData();

        $this->printObservableType($subject);

        $this->updateStatistics($data);
        $this->printStatistics();
    }

    public function setObservable(string $observableType, ObservableInterface $subject): void
    {
        $this->observableList[] = new ObservableData($observableType, $subject);
    }

    private function printObservableType(ObservableInterface $subject): void
    {
        $observableType = '';
        if (empty($this->observableList))
        {
            return;
        }
        foreach ($this->observableList as $observable)
        {
            if ($observable->getObservable() === $subject)
            {
                $observableType = $observable->getType();
                break;
            }
        }
        print_r('Observable type ' . $observableType . '</br>');
        print_r('----' . '</br>');
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