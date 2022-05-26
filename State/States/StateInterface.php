<?php
declare(strict_types=1);

namespace State\States;

interface StateInterface
{
    public function insertQuarter(): void;

    public function ejectAllQuarter(): void;

    public function ejectQuarter(): void;

    public function turnCrank(): void;

    public function dispense(): void;

    /**
     * @return string
     */
    public function toString(): string;

    /**
     * @param int $numBalls
     */
    public function refill(int $numBalls): void;
}