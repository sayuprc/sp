<?php

declare(strict_types=1);

namespace StrictPhp;

class Scope
{
    /**
     * @var array<string, mixed>
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->items[$key] ?? null;
    }

    public function remove(string $key): void
    {
        unset($this->items[$key]);
    }
}
