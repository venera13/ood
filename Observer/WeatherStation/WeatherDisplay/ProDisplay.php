<?php
declare(strict_types=1);

/**
 * @template T
 */
class ProDisplay implements ObserverInterface
{
    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        if ($observableType)
        {
            print_r('Observable type ' . $observableType . '</br>');
        }

        print_r('Current Temp ' . $weatherInfo->getTemperature() . '</br>');
        print_r('Current Hum ' . $weatherInfo->getHumidity() . '</br>');
        print_r('Current Pressure ' . $weatherInfo->getPressure() . '</br>');
        print_r('Current Wind speed ' . $weatherInfo->getWindSpeed() . '</br>');
        print_r('Current Wind direction ' . $weatherInfo->getWindDirection() . '</br>');
        print_r('------------------</br>');
    }
}