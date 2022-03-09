<?php
declare(strict_types=1);

/**
 * @template T
 */
class ProDisplay implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        $data = $subject->getChangedData()->getList();

        $subjectType = $subject instanceof WeatherDataInside ? 'Inside' : 'Outside';
        print_r('Observable type ' . $subjectType . '</br>');
        print_r('----' . '</br>');

        foreach ($data as $currentSubjectInfo)
        {
            print_r('Current ' . $currentSubjectInfo->getEventType() . ' ' . $currentSubjectInfo->getValue() . '</br>');
        }
        print_r('------------------</br>');
    }
}