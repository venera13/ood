<?php
declare(strict_types=1);

/**
 * @template T
 */
interface ObservableInterface
{
    public function registerObserver(ObserverInterface $observer, int $priority = 0): void;

    public function removeObserver(ObserverInterface $observer): void;
    
    public function notifyObservers(): void;
}