<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\WeatherData\WeatherDataInside;

/**
 * @template T
 */
class Display implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        $data = $subject->getChangedData()->getList();

        $subjectType = $subject instanceof WeatherDataInside ? 'Inside' : 'Outside';
        print_r('Observable type ' . $subjectType . '</br>');
        print_r('----' . '</br>');

        foreach ($data as $currentSubjectInfo)
        {
            if($currentSubjectInfo->getValue())
            {
                print_r('Current ' . $currentSubjectInfo->getEventType() . ' ' . $currentSubjectInfo->getValue() . '</br>');
            }
        }
        print_r('------------------</br>');
    }
}