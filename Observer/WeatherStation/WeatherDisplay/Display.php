<?php
declare(strict_types=1);

class Display implements ObserverInterface
{
    public function update($weatherInfo): void
    {
        print_r('Current Temp ' . $weatherInfo->getTemperature() . '</br>');
        print_r('Current Hum ' . $weatherInfo->getHumidity() . '</br>');
        print_r('Current Pressure ' . $weatherInfo->getPressure() . '</br>');
        print_r('------------------</br>');
    }
}