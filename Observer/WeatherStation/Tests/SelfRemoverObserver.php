<?php
declare(strict_types=1);

/**
 * @template T
 */
class SelfRemoverObserver implements ObserverInterface
{
    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        $weatherInfo->removeObserver($this);
    }
}