<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Data\ObservableData;
use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\Observable\ObservableInterface;
use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\WeatherData\WeatherDataInside;

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
        $observableType = $this->getObservableType($subject);

        print_r('Observable type ' . $observableType . '</br>');
        print_r('----' . '</br>');

        $data = $subject->getChangedData()->getList();

        $this->updateStatistics($data);
    }

    public function setObservable(string $observableType, ObservableInterface $subject): void
    {
        $this->observableList[] = new ObservableData($observableType, $subject);
    }

    private function getObservableType(ObservableInterface $subject): ?string
    {
        $observableType = null;
        if (empty($this->observableList))
        {
            return $observableType;
        }
        foreach ($this->observableList as $observable)
        {
            if ($observable->getObservable() === $subject)
            {
                $observableType = $observable->getType();
                break;
            }
        }
        return $observableType;
    }

    /**
     * @param $changedData
     */
    private function updateStatistics($changedData): void
    {
        $temperature = $this->findObservableStats($changedData, WeatherInfoType::TEMPERATURE);
        $humidity = $this->findObservableStats($changedData, WeatherInfoType::HUMIDITY);
        $pressure = $this->findObservableStats($changedData, WeatherInfoType::PRESSURE);
        $windSpeed = $this->findObservableStats($changedData, WeatherInfoType::WIND_SPEED);
        $windDirection = $this->findObservableStats($changedData, WeatherInfoType::WIND_DIRECTION);

        if ($temperature)
        {
            $this->temperatureStats->update($temperature->getValue());
            $this->printStatistic('Temperature', $this->temperatureStats);
        }
        if ($humidity)
        {
            $this->humidityStats->update($humidity->getValue());
            $this->printStatistic('Humidity', $this->humidityStats);
        }
        if ($pressure)
        {
            $this->pressureStats->update($pressure->getValue());
            $this->printStatistic('Pressure', $this->pressureStats);
        }
        if ($windSpeed)
        {
            $this->windSpeedStats->update($windSpeed->getValue());
            $this->printStatistic('Wind speed', $this->windSpeedStats);
        }
        if ($windDirection)
        {
            $this->windDirectionStats->update($windDirection->getValue());
            $this->printStatistic('Wind direction', $this->windDirectionStats);
        }
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

    /**
     * @param $changedData
     * @param string $eventType
     * @return mixed
     */
    private function findObservableStats($changedData, string $eventType): mixed
    {
        $result = null;
        foreach ($changedData as $currentSubjectInfo)
        {
            if ($currentSubjectInfo->getEventType() === $eventType)
            {
                $result = $currentSubjectInfo;
                break;
            }
        }
        return $result;
    }
}