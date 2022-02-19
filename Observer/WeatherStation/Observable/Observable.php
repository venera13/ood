<?php
declare(strict_types=1);

/**
 * @template T
 */
abstract class Observable implements ObservableInterface
{
    /** @var array */
    private $observers = [];
    
    public function registerObserver(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }
    
    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value)
        {
            if ($value === $observer)
            {
                unset($this->observers[$key]);
            }
        }
    }
    
    public function notifyObservers(): void
    {
        $data = $this->getChangedData();

        foreach ($this->observers as $observer)
        {
            $observer->update($data);
        }
    }

    /**
     * @return T
     */
    protected abstract function getChangedData();
}