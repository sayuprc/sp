<?php

declare(strict_types=1);

namespace StrictPhp;

class NamespaceObject
{
    /**
     * @param array<string, FunctionObject> $functions
     */
    public function __construct(
        public Scope $currentScope = new Scope(),
        public array $functions = []
    ) {
    }
}
