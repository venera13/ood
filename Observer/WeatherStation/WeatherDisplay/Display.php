<?php
declare(strict_types=1);

/**
 * @template T
 */
class Display implements ObserverInterface
{
    /** @var ObservableInterface */
    private $observableInside;
    /** @var ObservableInterface */
    private $observableOutside;
    /** @var WeatherInfo */
    private $weatherInfo;
    /** @var WeatherInfoPro */
    private $weatherInfoPro;

    public function __construct(ObservableInterface $observableInside, ObservableInterface $observableOutside)
    {
        $this->observableInside = $observableInside;
        $this->observableOutside = $observableOutside;
    }

    public function update(ObservableInterface $subject): void
    {
        if ($subject === $this->observableInside)
        {
            print_r('Observable type Inside </br>');
            print_r('----' . '</br>');
            $this->weatherInfo = $subject->getChangedData();
            $this->printWeatherInfo();
        }
        else if ($subject === $this->observableOutside)
        {
            print_r('Observable type Outside </br>');
            print_r('----' . '</br>');
            $this->weatherInfoPro = $subject->getChangedData();
            $this->printWeatherInfoPro();
        }
        print_r('------------------</br>');
    }

    private function printWeatherInfo(): void
    {
        print_r('Current temperature ' . $this->weatherInfo->getTemperature() . '</br>');
        print_r('Current humidity ' . $this->weatherInfo->getHumidity() . '</br>');
        print_r('Current pressure ' . $this->weatherInfo->getPressure() . '</br>');
    }

    private function printWeatherInfoPro(): void
    {
        print_r('Current temperature ' . $this->weatherInfoPro->getTemperature() . '</br>');
        print_r('Current humidity ' . $this->weatherInfoPro->getHumidity() . '</br>');
        print_r('Current pressure ' . $this->weatherInfoPro->getPressure() . '</br>');
        print_r('Current wind speed ' . $this->weatherInfoPro->getWindSpeed() . '</br>');
        print_r('Current wind direction ' . $this->weatherInfoPro->getWindDirection() . '</br>');
    }
}