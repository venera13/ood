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
    /** @var string|null */
    private $type = null;

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function registerObserver(ObserverInterface $observer, int $priority = 0): void
    {
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
                $observer->getObserver()->update($data, $this->type);
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
    protected abstract function getChangedData();

    private function sortObservers(): void
    {
        usort($this->observers, static function($firstValue, $secondValue): int
        {
            return $firstValue->getPriority() <= $secondValue->getPriority() ? 1 : -1;
        });
    }
}