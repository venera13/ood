<?php
declare(strict_types=1);

/**
 * @template T
 */
class Display implements ObserverInterface
{
    /** @var ObservableData[] */
    private $observableList;

    public function update(ObservableInterface $subject): void
    {
        $observableType = $this->getObservableType($subject);

        print_r('Observable type ' . $observableType . '</br>');
        print_r('----' . '</br>');

        $data = $subject->getChangedData();

        if ($observableType === 'Inside')
        {
            $this->printWeatherInfo($data);
        }
        else if ($observableType === 'Outside')
        {
            $this->printWeatherInfoPro($data);
        }
        print_r('------------------</br>');
    }

    public function setObservable(string $observableType, ObservableInterface $subject): void
    {
        $this->observableList[] = new ObservableData($observableType, $subject);
    }

    private function printWeatherInfo(WeatherInfo $weatherInfo): void
    {
        print_r('Current temperature ' . $weatherInfo->getTemperature() . '</br>');
        print_r('Current humidity ' . $weatherInfo->getHumidity() . '</br>');
        print_r('Current pressure ' . $weatherInfo->getPressure() . '</br>');
    }

    private function printWeatherInfoPro(WeatherInfoPro $weatherInfoPro): void
    {
        print_r('Current temperature ' . $weatherInfoPro->getTemperature() . '</br>');
        print_r('Current humidity ' . $weatherInfoPro->getHumidity() . '</br>');
        print_r('Current pressure ' . $weatherInfoPro->getPressure() . '</br>');
        print_r('Current wind speed ' . $weatherInfoPro->getWindSpeed() . '</br>');
        print_r('Current wind direction ' . $weatherInfoPro->getWindDirection() . '</br>');
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
}