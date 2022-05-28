<?php
//declare(strict_types=1);

namespace MVC\Model;

class Harmonic
{
    /** @var float */
    private $amplitude;
    /** @var float */
    private $frequency;
    /** @var float */
    private $phase;

    public function __construct(float $amplitude, float $frequency, float $phase)
    {
        $this->amplitude = $amplitude;
        $this->frequency = $frequency;
        $this->phase = $phase;
    }

    /**
     * @return float
     */
    public function getAmplitude(): float
    {
        return $this->amplitude;
    }

    /**
     * @return float
     */
    public function getFrequency(): float
    {
        return $this->frequency;
    }

    /**
     * @return float
     */
    public function getPhase(): float
    {
        return $this->phase;
    }
}