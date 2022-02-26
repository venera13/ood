<?php
declare(strict_types=1);

/**
 * @template T
 */
class Display implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        $data = $subject->getChangedData();
        if ($subject->getType())
        {
            print_r('Observable type ' . $subject->getType() . '</br>');
        }

        print_r('Current Temp ' . $data->getTemperature() . '</br>');
        print_r('Current Hum ' . $data->getHumidity() . '</br>');
        print_r('Current Pressure ' . $data->getPressure() . '</br>');
        print_r('------------------</br>');
    }
}