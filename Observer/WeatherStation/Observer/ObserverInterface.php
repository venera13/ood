<?php
declare(strict_types=1);

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param T $weatherInfo
     * @param string|null $observableType
     */
    public function update(mixed $weatherInfo, ?string $observableType = null): void;
}