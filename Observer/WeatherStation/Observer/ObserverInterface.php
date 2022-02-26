<?php
declare(strict_types=1);

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param T $subject
     */
    public function update(mixed $subject): void;
}