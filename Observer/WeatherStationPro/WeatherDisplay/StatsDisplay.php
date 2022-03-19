<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Data\ObservableData;
use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\Observable\ObservableInterface;
use Observer\WeatherStationPro\Observer\ObserverInterface;

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var ObservableData[] */
    private $observableList;
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