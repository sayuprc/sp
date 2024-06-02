<?php

declare(strict_types=1);

namespace StrictPhp;

class Scope
{
    /**
     * @var array<string, mixed>
     */
    private array $items;

    public function __construct(public readonly ?Scope $parentScope = null)
    {
        $this->items = [];
    }

    public function set(string $key, mixed $value): void
    {
        $this->items[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $this->items[$key] ?? null;
    }

    public function remove(string $key): void
    {
        unset($this->items[$key]);
    }

    public function merge(Scope $other): void
    {
        $this->items = array_merge($this->items, $other->items);
    }
}
