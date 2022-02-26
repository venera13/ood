<?php
declare(strict_types=1);

/**
 * @template T
 */
class FirstObserver implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        echo '1';
    }
}