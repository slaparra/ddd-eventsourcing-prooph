<?php

namespace SharedKernel\Common\Collection;

use ArrayAccess;
use Closure;
use Countable;
use IteratorAggregate;

interface Collection extends Countable, IteratorAggregate, ArrayAccess
{
    public function add($element): void;

    public function clear(): void;

    /**
     * @param mixed $element
     * @return bool
     */
    public function contains($element): bool;

    /**
     * @param string|int $key
     * @return bool
     */
    public function containsKey($key): bool;

    public function isEmpty(): bool;

    /**
     * @param string|int $key.
     *
     * @return mixed|null.
     */
    public function remove($key);

    /**
     * @param mixed $element
     *
     * @return bool
     */
    public function removeElement($element): bool;

    /**
     * @param string|int $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param string|int $key
     * @param mixed      $value
     *
     * @return void
     */
    public function set($key, $value): void;

    /**
     * @return mixed
     */
    public function first();

    /**
     * @return mixed
     */
    public function last();

    /**
     * @return mixed
     */
    public function current();

    /**
     * @return mixed
     */
    public function next();

    public function exists(Closure $p): bool;

    public function filter(Closure $p): Collection;

    public function map(Closure $func): Collection;

    public function toArray(): array;
}
