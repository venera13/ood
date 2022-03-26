<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Domain\WeatherInfoType;
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
    private $weatherInfo;
    /** @var array */
    private $weatherInfoPro;
    /** @var array */
    private $weatherDataSensorStats;
    /** @var array */
    private $weatherProDataSensorStats;

    public function __construct(ObservableInterface $observableInside, ObservableInterface $observableOutside)
    {
        $this->observableInside = $observableInside;
        $this->observableOutside = $observableOutside;

        $this->weatherDataSensorStats = [
            WeatherInfoType::TEMPERATURE => new StatsCalculator(),
            WeatherInfoType::HUMIDITY => new StatsCalculator(),
            WeatherInfoType::PRESSURE => new StatsCalculator(),
        ];
        $this->weatherProDataSensorStats = [
            WeatherInfoType::TEMPERATURE => new StatsCalculator(),
            WeatherInfoType::HUMIDITY => new StatsCalculator(),
            WeatherInfoType::PRESSURE => new StatsCalculator(),
            WeatherInfoType::WIND_SPEED => new StatsCalculator(),
            WeatherInfoType::WIND_DIRECTION => new StatsWindDirectionCalculator(),
        ];
    }

    public function update(ObservableInterface $subject): void
    {
        if ($subject === $this->observableInside)
        {
            print_r('Observable type Inside </br>');
            print_r('----' . '</br>');
            $this->weatherInfo = $subject->getChangedData();
            $this->updateWeatherInfoStatistic();
            $this->printWeatherInfoStatistic();
        }
        else if ($subject === $this->observableOutside)
        {
            print_r('Observable type Outside </br>');
            print_r('----' . '</br>');
            $this->weatherInfoPro = $subject->getChangedData();
            $this->updateWeatherInfoProStatistic();
            $this->printWeatherInfoProStatistic();
        }
    }

    private function updateWeatherInfoStatistic(): void
    {
        $temperature = $this->findObservableStats($this->weatherInfo, WeatherInfoType::TEMPERATURE);
        $humidity = $this->findObservableStats($this->weatherInfo, WeatherInfoType::HUMIDITY);
        $pressure = $this->findObservableStats($this->weatherInfo, WeatherInfoType::PRESSURE);

        $this->weatherDataSensorStats[WeatherInfoType::TEMPERATURE]->update($temperature->getValue());
        $this->weatherDataSensorStats[WeatherInfoType::HUMIDITY]->update($humidity->getValue());
        $this->weatherDataSensorStats[WeatherInfoType::PRESSURE]->update($pressure->getValue());
    }

    private function updateWeatherInfoProStatistic(): void
    {
        $temperature = $this->findObservableStats($this->weatherInfoPro, WeatherInfoType::TEMPERATURE);
        $humidity = $this->findObservableStats($this->weatherInfoPro, WeatherInfoType::HUMIDITY);
        $pressure = $this->findObservableStats($this->weatherInfoPro, WeatherInfoType::PRESSURE);
        $windSpeed = $this->findObservableStats($this->weatherInfoPro, WeatherInfoType::WIND_SPEED);
        $windDirection = $this->findObservableStats($this->weatherInfoPro, WeatherInfoType::WIND_DIRECTION);

        $this->weatherProDataSensorStats[WeatherInfoType::TEMPERATURE]->update($temperature->getValue());
        $this->weatherProDataSensorStats[WeatherInfoType::HUMIDITY]->update($humidity->getValue());
        $this->weatherProDataSensorStats[WeatherInfoType::PRESSURE]->update($pressure->getValue());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_SPEED]->update($windSpeed->getValue());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_DIRECTION]->update($windDirection->getValue());
    }

    private function printWeatherInfoStatistic(): void
    {
        $this->printStatistic(WeatherInfoType::TEMPERATURE, $this->weatherDataSensorStats[WeatherInfoType::TEMPERATURE]);
        $this->printStatistic(WeatherInfoType::HUMIDITY, $this->weatherDataSensorStats[WeatherInfoType::HUMIDITY]);
        $this->printStatistic(WeatherInfoType::PRESSURE, $this->weatherDataSensorStats[WeatherInfoType::PRESSURE]);
    }

    private function printWeatherInfoProStatistic(): void
    {
        $this->printStatistic(WeatherInfoType::TEMPERATURE, $this->weatherProDataSensorStats[WeatherInfoType::TEMPERATURE]);
        $this->printStatistic(WeatherInfoType::HUMIDITY, $this->weatherProDataSensorStats[WeatherInfoType::HUMIDITY]);
        $this->printStatistic(WeatherInfoType::PRESSURE, $this->weatherProDataSensorStats[WeatherInfoType::PRESSURE]);
        $this->printStatistic(WeatherInfoType::WIND_SPEED, $this->weatherProDataSensorStats[WeatherInfoType::WIND_SPEED]);
        $this->printStatistic(WeatherInfoType::WIND_DIRECTION, $this->weatherProDataSensorStats[WeatherInfoType::WIND_DIRECTION]);
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