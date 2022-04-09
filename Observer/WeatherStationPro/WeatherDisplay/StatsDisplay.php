<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Data\WeatherInfo;
use Observer\WeatherStationPro\Data\WeatherInfoPro;
use Observer\WeatherStationPro\Event\EventInterface;
use Observer\WeatherStationPro\Event\WeatherInfoEvent;
use Observer\WeatherStationPro\Observable\ObservableInterface;
use Observer\WeatherStationPro\Observer\ObserverInterface;

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var ObservableInterface */
    private $observableInside;
    /** @var ObservableInterface */
    private $observableOutside;
    /** @var array */
    private $weatherDataSensorStats;
    /** @var array */
    private $weatherProDataSensorStats;

    public function __construct(ObservableInterface $observableInside, ObservableInterface $observableOutside)
    {
        $this->observableInside = $observableInside;
        $this->observableOutside = $observableOutside;

        $this->weatherDataSensorStats = [
            WeatherInfoEvent::TEMPERATURE_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::HUMIDITY_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::PRESSURE_CHANGED => new StatsCalculator(),
        ];
        $this->weatherProDataSensorStats = [
            WeatherInfoEvent::TEMPERATURE_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::HUMIDITY_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::PRESSURE_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::WIND_SPEED_CHANGED => new StatsCalculator(),
            WeatherInfoEvent::WIND_DIRECTION_CHANGED => new StatsWindDirectionCalculator(),
        ];
    }

    public function update(EventInterface $event, ObservableInterface $subject): void
    {
        if ($subject === $this->observableInside)
        {
            print_r('Observable type Inside </br>');
            print_r('----' . '</br>');
            $this->updateWeatherInfoStatistic($event, $this->observableInside->getChangedData());
            $this->printWeatherInfoStatistic($event);
        }
        else if ($subject === $this->observableOutside)
        {
            print_r('Observable type Outside </br>');
            print_r('----' . '</br>');
            $this->updateWeatherInfoProStatistic($event, $this->observableOutside->getChangedData());
            $this->printWeatherInfoProStatistic($event);
        }
    }

    private function updateWeatherInfoStatistic(EventInterface $event, WeatherInfo $weatherInfo): void
    {
        if ($event->getType() === WeatherInfoEvent::TEMPERATURE_CHANGED)
        {
            $this->weatherDataSensorStats[WeatherInfoEvent::TEMPERATURE_CHANGED]->update($weatherInfo->getTemperature());
        }

        if ($event->getType() === WeatherInfoEvent::HUMIDITY_CHANGED)
        {
            $this->weatherDataSensorStats[WeatherInfoEvent::HUMIDITY_CHANGED]->update($weatherInfo->getHumidity());
        }

        if ($event->getType() === WeatherInfoEvent::PRESSURE_CHANGED)
        {
            $this->weatherDataSensorStats[WeatherInfoEvent::PRESSURE_CHANGED]->update($weatherInfo->getPressure());
        }
    }

    private function updateWeatherInfoProStatistic(EventInterface $event, WeatherInfoPro $weatherInfo): void
    {
        if ($event->getType() === WeatherInfoEvent::TEMPERATURE_CHANGED)
        {
            $this->weatherProDataSensorStats[WeatherInfoEvent::TEMPERATURE_CHANGED]->update($weatherInfo->getTemperature());
        }
        if ($event->getType() === WeatherInfoEvent::HUMIDITY_CHANGED)
        {
            $this->weatherProDataSensorStats[WeatherInfoEvent::HUMIDITY_CHANGED]->update($weatherInfo->getHumidity());
        }
        if ($event->getType() === WeatherInfoEvent::PRESSURE_CHANGED)
        {
            $this->weatherProDataSensorStats[WeatherInfoEvent::PRESSURE_CHANGED]->update($weatherInfo->getPressure());
        }
        if ($event->getType() === WeatherInfoEvent::WIND_SPEED_CHANGED)
        {
            $this->weatherProDataSensorStats[WeatherInfoEvent::WIND_SPEED_CHANGED]->update($weatherInfo->getWindSpeed());
        }
        if ($event->getType() === WeatherInfoEvent::WIND_DIRECTION_CHANGED)
        {
            $this->weatherProDataSensorStats[WeatherInfoEvent::WIND_DIRECTION_CHANGED]->update($weatherInfo->getWindDirection());
        }
    }

    private function printWeatherInfoStatistic(EventInterface $event): void
    {
        if ($event->getType() === WeatherInfoEvent::TEMPERATURE_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::TEMPERATURE_CHANGED, $this->weatherDataSensorStats[WeatherInfoEvent::TEMPERATURE_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::HUMIDITY_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::HUMIDITY_CHANGED, $this->weatherDataSensorStats[WeatherInfoEvent::HUMIDITY_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::PRESSURE_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::PRESSURE_CHANGED, $this->weatherDataSensorStats[WeatherInfoEvent::PRESSURE_CHANGED]);
        }
    }

    private function printWeatherInfoProStatistic(EventInterface $event): void
    {
        if ($event->getType() === WeatherInfoEvent::TEMPERATURE_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::TEMPERATURE_CHANGED, $this->weatherProDataSensorStats[WeatherInfoEvent::TEMPERATURE_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::HUMIDITY_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::HUMIDITY_CHANGED, $this->weatherProDataSensorStats[WeatherInfoEvent::HUMIDITY_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::PRESSURE_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::PRESSURE_CHANGED, $this->weatherProDataSensorStats[WeatherInfoEvent::PRESSURE_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::WIND_SPEED_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::WIND_SPEED_CHANGED, $this->weatherProDataSensorStats[WeatherInfoEvent::WIND_SPEED_CHANGED]);
        }
        if ($event->getType() === WeatherInfoEvent::WIND_DIRECTION_CHANGED)
        {
            $this->printStatistic(WeatherInfoEvent::WIND_DIRECTION_CHANGED, $this->weatherProDataSensorStats[WeatherInfoEvent::WIND_DIRECTION_CHANGED]);
        }
    }

    /**
     * @param string $paramName
     * @param StatsCalculator|StatsWindDirectionCalculator $stats
     */
    private function printStatistic(string $paramName, StatsCalculator|StatsWindDirectionCalculator $stats): void
    {
        if (method_exists($stats, 'getMinValue')) print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        if (method_exists($stats, 'getMaxValue')) print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        if (method_exists($stats, 'getAverage')) print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }

    /**
     * @param array $changedData
     * @param string $eventType
     * @return mixed
     */
    private function findObservableStats(array $changedData, string $eventType): mixed
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