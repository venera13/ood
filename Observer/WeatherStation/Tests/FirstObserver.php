<?php
declare(strict_types=1);

/**
 * @template T
 */
class FirstObserver implements ObserverInterface
{
    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        echo '1';
    }
}