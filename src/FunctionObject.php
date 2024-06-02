<?php

declare(strict_types=1);

namespace StrictPhp;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt;

class FunctionObject
{
    /**
     * @param array<int, Param> $params
     * @param array<int, Stmt>  $stmts
     */
    public function __construct(public readonly array $params, public readonly array $stmts)
    {
    }
}
