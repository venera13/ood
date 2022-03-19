<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var ObservableData[] */
    private $observableList;
    /** @var array */
    private $weatherDataSensorStats;
    /** @var array */
    private $weatherProDataSensorStats;

    public function __construct()
    {
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
        $observableType = $this->getObservableType($subject);

        print_r('Observable type ' . $observableType . '</br>');
        print_r('----' . '</br>');

        $this->updateStatistics($subject, $observableType);
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
     * @param mixed $subject
     */
    private function updateStatistics(ObservableInterface $subject, string $observableType): void
    {
        $data = $subject->getChangedData();

        if ($observableType === 'Inside')
        {
            $this->updateWeatherInfoStatistic($data);
            $this->printWeatherInfoStatistic();
        }
        else if ($observableType === 'Outside')
        {
            $this->updateWeatherInfoProStatistic($data);
            $this->printWeatherInfoProStatistic();
        }
    }

    private function updateWeatherInfoStatistic(WeatherInfo $weatherInfo): void
    {
        $this->weatherDataSensorStats[WeatherInfoType::TEMPERATURE]->update($weatherInfo->getTemperature());
        $this->weatherDataSensorStats[WeatherInfoType::HUMIDITY]->update($weatherInfo->getHumidity());
        $this->weatherDataSensorStats[WeatherInfoType::PRESSURE]->update($weatherInfo->getPressure());
    }

    private function updateWeatherInfoProStatistic(WeatherInfoPro $weatherInfoPro): void
    {
        $this->weatherProDataSensorStats[WeatherInfoType::TEMPERATURE]->update($weatherInfoPro->getTemperature());
        $this->weatherProDataSensorStats[WeatherInfoType::HUMIDITY]->update($weatherInfoPro->getHumidity());
        $this->weatherProDataSensorStats[WeatherInfoType::PRESSURE]->update($weatherInfoPro->getPressure());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_SPEED]->update($weatherInfoPro->getWindSpeed());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_DIRECTION]->update($weatherInfoPro->getWindDirection());
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
}