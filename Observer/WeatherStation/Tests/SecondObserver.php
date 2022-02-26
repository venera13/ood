<?php
declare(strict_types=1);

/**
 * @template T
 */
class SecondObserver implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        echo '2';
    }
}