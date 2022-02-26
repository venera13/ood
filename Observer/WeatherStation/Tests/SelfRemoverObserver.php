<?php
declare(strict_types=1);

/**
 * @template T
 */
class SelfRemoverObserver implements ObserverInterface
{
    public function update(mixed $subject): void
    {
        $subject->removeObserver($this);
    }
}