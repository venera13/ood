<?php
declare(strict_types=1);

namespace State\GumballMachine;

interface GumballMachineInterface
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
}