<?php
declare(strict_types=1);

class WeatherDuoInfoList
{
    /** @var WeatherDuoInfo[] */
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return WeatherDuoInfo[]
     */
    public function getList(): array
    {
        return $this->list;
    }
}