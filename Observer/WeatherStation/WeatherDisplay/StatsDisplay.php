<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var ObservableInterface */
    private $observableInside;
    /** @var ObservableInterface */
    private $observableOutside;
    /** @var WeatherInfo */
    private $weatherInfo;
    /** @var WeatherInfoPro */
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
        $this->weatherDataSensorStats[WeatherInfoType::TEMPERATURE]->update($this->weatherInfo->getTemperature());
        $this->weatherDataSensorStats[WeatherInfoType::HUMIDITY]->update($this->weatherInfo->getHumidity());
        $this->weatherDataSensorStats[WeatherInfoType::PRESSURE]->update($this->weatherInfo->getPressure());
    }

    private function updateWeatherInfoProStatistic(): void
    {
        $this->weatherProDataSensorStats[WeatherInfoType::TEMPERATURE]->update($this->weatherInfoPro->getTemperature());
        $this->weatherProDataSensorStats[WeatherInfoType::HUMIDITY]->update($this->weatherInfoPro->getHumidity());
        $this->weatherProDataSensorStats[WeatherInfoType::PRESSURE]->update($this->weatherInfoPro->getPressure());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_SPEED]->update($this->weatherInfoPro->getWindSpeed());
        $this->weatherProDataSensorStats[WeatherInfoType::WIND_DIRECTION]->update($this->weatherInfoPro->getWindDirection());
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