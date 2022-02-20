<?php
declare(strict_types=1);

/**
 * @template T
 */
class SelfRemoverObserver implements ObserverInterface
{
    public function update($weatherInfo): void
    {
        $weatherInfo->removeObserver($this);
    }
}