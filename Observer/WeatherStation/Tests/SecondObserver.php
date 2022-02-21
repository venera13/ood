<?php
declare(strict_types=1);

/**
 * @template T
 */
class SecondObserver implements ObserverInterface
{
    public function update($weatherInfo): void
    {
        echo '2';
        //fwrite(STDERR, print_r(2, TRUE));
    }
}