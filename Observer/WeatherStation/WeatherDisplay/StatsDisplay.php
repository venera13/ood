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
            'temperature' => new StatsCalculator(),
            'humidity' => new StatsCalculator(),
            'pressure' => new StatsCalculator(),
        ];
        $this->weatherProDataSensorStats = [
            'temperature' => new StatsCalculator(),
            'humidity' => new StatsCalculator(),
            'pressure' => new StatsCalculator(),
            'windSpeed' => new StatsCalculator(),
            'windDirection' => new StatsWindDirectionCalculator(),
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
        $this->weatherDataSensorStats['temperature']->update($weatherInfo->getTemperature());
        $this->weatherDataSensorStats['humidity']->update($weatherInfo->getHumidity());
        $this->weatherDataSensorStats['pressure']->update($weatherInfo->getPressure());
    }

    private function updateWeatherInfoProStatistic(WeatherInfoPro $weatherInfoPro): void
    {
        $this->weatherProDataSensorStats['temperature']->update($weatherInfoPro->getTemperature());
        $this->weatherProDataSensorStats['humidity']->update($weatherInfoPro->getHumidity());
        $this->weatherProDataSensorStats['pressure']->update($weatherInfoPro->getPressure());
        $this->weatherProDataSensorStats['windSpeed']->update($weatherInfoPro->getWindSpeed());
        $this->weatherProDataSensorStats['windDirection']->update($weatherInfoPro->getWindDirection());
    }

    private function printWeatherInfoStatistic(): void
    {
        $this->printStatistic('temperature', $this->weatherDataSensorStats['temperature']);
        $this->printStatistic('humidity', $this->weatherDataSensorStats['humidity']);
        $this->printStatistic('pressure', $this->weatherDataSensorStats['pressure']);
    }

    private function printWeatherInfoProStatistic(): void
    {
        $this->printStatistic('temperature', $this->weatherProDataSensorStats['temperature']);
        $this->printStatistic('humidity', $this->weatherProDataSensorStats['humidity']);
        $this->printStatistic('pressure', $this->weatherProDataSensorStats['pressure']);
        $this->printStatistic('windSpeed', $this->weatherProDataSensorStats['windSpeed']);
        $this->printStatistic('windDirection', $this->weatherProDataSensorStats['windDirection']);
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