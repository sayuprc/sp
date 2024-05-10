<?php

declare(strict_types=1);

namespace StrictPhp;

class BreakObject
{
    /**
     * @param positive-int $num
     */
    public function __construct(private int $num)
    {
    }

    /**
     * @return positive-int
     */
    public function num(): int
    {
        return $this->num;
    }

    public function decrement(): void
    {
        $this->num -= 1;
    }
}
