<?php
declare(strict_types=1);

include 'Exceptions/NotifyObserverException.php';

/**
 * @template T
 */
abstract class Observable implements ObservableInterface
{
    /** @var array */
    public $observers = [];
    
    public function registerObserver(ObserverInterface $observer, int $priority = 0): void
    {
        $this->observers[] = [
            'priority' => $priority,
            'observer' => $observer
        ];

        $this->sortObservers();
    }
    
    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value)
        {
            if ($value['observer'] === $observer)
            {
                unset($this->observers[$key]);
            }
        }
    }
    
    public function notifyObservers(): void
    {
        try
        {
            $data = $this->getChangedData();

            foreach ($this->observers as $observer)
            {
                $observer['observer']->update($data);
            }
        }
        catch (Throwable $exception)
        {
            throw new NotifyObserverException();
        }
    }

    /**
     * @return T
     */
    protected abstract function getChangedData();

    private function sortObservers(): void
    {
        usort($this->observers, static function($firstValue, $secondValue): int
        {
            return $firstValue['priority'] <= $secondValue['priority'] ? 1 : -1;
        });
    }
}