<?php
declare(strict_types=1);

/**
 * @template T
 */
class ObserverWithCheckType implements ObserverInterface
{
    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        echo $observableType;
    }
}