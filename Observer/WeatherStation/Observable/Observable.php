<?php
declare(strict_types=1);

include 'Exceptions/NotifyObserverException.php';

/**
 * @template T
 */
abstract class Observable implements ObservableInterface
{
    /** @var ObserverData[] */
    public $observers = [];

    public function registerObserver(
        ObserverInterface $observer,
        int $priority = 0
    ): void {
        $this->observers[] = new ObserverData(
            $priority,
            $observer
        );

        $this->sortObservers();
    }
    
    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value)
        {
            if ($value->getObserver() === $observer)
            {
                unset($this->observers[$key]);
                break;
            }
        }
        $this->observers = array_values($this->observers);
    }
    
    public function notifyObservers(): void
    {
        try
        {
            foreach ($this->observers as $observer)
            {
                $observer->getObserver()->update($this);
            }
        }
        catch (Throwable $exception)
        {
            throw new NotifyObserverException($exception->getMessage());
        }
    }

    /**
     * @return T
     */
    public abstract function getChangedData();

    private function sortObservers(): void
    {
        usort($this->observers, static function($firstValue, $secondValue): int
        {
            return $firstValue->getPriority() < $secondValue->getPriority() ? 1 : -1;
        });
    }
}