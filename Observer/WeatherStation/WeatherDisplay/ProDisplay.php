<?php
declare(strict_types=1);

/**
 * @template T
 */
class ProDisplay implements ObserverInterface
{
    public function update(ObservableInterface $subject): void
    {
        $data = $subject->getChangedData()->getList();

        $this->printObservableType($subject);

        foreach ($data as $currentSubjectInfo)
        {
            if($currentSubjectInfo->getValue() !== null)
            {
                print_r('Current ' . $currentSubjectInfo->getEventType() . ' ' . $currentSubjectInfo->getValue() . '</br>');
            }
        }
        print_r('------------------</br>');
    }

    private function printObservableType(ObservableInterface $subject): void
    {
        $observableType = '';
        if (empty($this->observableList))
        {
            return;
        }
        foreach ($this->observableList as $observable)
        {
            if ($observable->getObservable() === $subject)
            {
                $observableType = $observable->getType();
                break;
            }
        }
        print_r('Observable type ' . $observableType . '</br>');
        print_r('----' . '</br>');
    }
}