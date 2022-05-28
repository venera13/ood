<?php
declare(strict_types=1);

namespace MVC\Model;

class Harmonic
{
    /** @var float */
    private $amplitude;
    /** @var string */
    private $harmonicType;
    /** @var float */
    private $frequency;
    /** @var float */
    private $phase;

    public function __construct(float $amplitude, string $harmonicType, float $frequency, float $phase)
    {
        $this->amplitude = $amplitude;
        $this->harmonicType = $harmonicType;
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
     * @return string
     */
    public function getHarmonicType(): string
    {
        return $this->harmonicType;
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

    /**
     * @param float $amplitude
     */
    public function setAmplitude(float $amplitude): void
    {
        $this->amplitude = $amplitude;
    }

    /**
     * @param string $harmonicType
     */
    public function setHarmonicType(string $harmonicType): void
    {
        $this->harmonicType = $harmonicType;
    }

    /**
     * @param float $frequency
     */
    public function setFrequency(float $frequency): void
    {
        $this->frequency = $frequency;
    }

    /**
     * @param float $phase
     */
    public function setPhase(float $phase): void
    {
        $this->phase = $phase;
    }

    /**
     * @param float $x
     * @return float
     */
    public function calculateValue(float $x): float
    {
        $harmonicType = $this->harmonicType;
        return $this->amplitude * $harmonicType($this->frequency * $x + $this->phase);
    }
}