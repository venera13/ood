<?php

namespace State\GumballMachine;

interface GumballMachineContextInterface
{
    public function releaseBall(): void;

    /**
     * @return int
     */
    public function getBallCount(): int;

    /**
     * @return int
     */
    public function getQuarterCount(): int;

    public function addQuarter(): void;

    /**
     * @param int $numBalls
     */
    public function addBalls(int $numBalls): void;

    public function setSoldOutState(): void;

    public function setNoQuarterState(): void;

    public function setSoldState(): void;

    public function setHasQuarterState(): void;

    public function decreaseQuarter(): void;

    public function ejectQuarter(): void;

    public function insertQuarter(): void;

    public function refill(int $numBalls): void;

    public function turnCrank(): void;

    public function toString(): void;
}