<?php
declare(strict_types=1);

/**
 * @template T
 */
class FirstObserver implements ObserverInterface
{
    public function update($weatherInfo): void
    {
        echo '1';
        //fwrite(STDERR, print_r(1, TRUE));
    }
}