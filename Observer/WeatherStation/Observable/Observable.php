<?php
declare(strict_types=1);

class Observable implements ObservableInterface
{
    /** @var array */
    private $observers = [];
    
    public function registerObserver(ObserverInterface $observer): void
    {
        $observers[] = $observer;
    }
    
    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value)
        {
            if ($value !== $observer)
            {
                unset($this->observers[$key]);
            }
        }
    }
    
    public function notifyObservers(): void
    {
    
    }
}