<?php
declare(strict_types=1);

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param T $weatherInfo
     */
    public function update($weatherInfo): void;
}