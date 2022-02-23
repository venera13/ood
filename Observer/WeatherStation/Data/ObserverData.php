<?php
declare(strict_types=1);

class ObserverData
{
    /** @var int */
    private $priority;
    /** @var ObserverInterface */
    private $observer;

    public function __construct(int $priority, ObserverInterface $observer)
    {
        $this->priority = $priority;
        $this->observer = $observer;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return ObserverInterface
     */
    public function getObserver(): ObserverInterface
    {
        return $this->observer;
    }
}