<?php

declare(strict_types=1);

namespace StrictPhp;

use PhpParser\Node\Expr;
use PhpParser\Node\Param;

class ArrowFunctionObject
{
    /**
     * @param array<int, Param> $params
     */
    public function __construct(public readonly array $params, public readonly Expr $expr)
    {
    }
}
