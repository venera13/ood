<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

use Observer\WeatherStationPro\Observable\ObservableInterface;

class ObservableData
{
    /** @var string */
    private $type;
    /** @var ObservableInterface */
    private $observable;

    public function __construct(string $type, ObservableInterface $observable)
    {
        $this->type = $type;
        $this->observable = $observable;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return ObservableInterface
     */
    public function getObservable(): ObservableInterface
    {
        return $this->observable;
    }
}