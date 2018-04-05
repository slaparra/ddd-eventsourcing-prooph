<?php

namespace SharedKernel\Common\Collection;

use Closure;
use Doctrine\Common\Collections\ArrayCollection as DoctrineArrayCollection;

class ArrayCollection implements Collection
{
    /**
     * @var DoctrineArrayCollection
     */
    private $collection;

    protected function __construct(array $array)
    {
        $this->collection = new DoctrineArrayCollection($array);
    }

    public static function createFromArray(array $elements)
    {
        return new static($elements);
    }

    public static function createEmpty()
    {
        return new static([]);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Traversable
    {
        return $this->collection->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset): bool
    {
        return $this->collection->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->collection->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        $this->collection->offsetSet($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset): void
    {
        $this->collection->offsetUnset($offset);
    }

    public function filter(Closure $filterMethod): Collection
    {
        return $this->createFromArray($this->collection->filter($filterMethod)->toArray());
    }

    public function map(Closure $func): Collection
    {
        return $this->createFromArray($this->collection->map($func)->toArray());
    }

    /**
     * @param string|int $key
     * @param mixed      $value
     */
    public function set($key, $value): void
    {
        $this->collection->set($key, $value);
    }

    public function toArray(): array
    {
        return $this->collection->toArray();
    }

    public function add($element): void
    {
        $this->collection->add($element);
    }

    public function clear(): void
    {
        $this->collection->clear();
    }

    public function contains($element): bool
    {
        return $this->collection->contains($element);
    }

    public function containsKey($key): bool
    {
        return $this->collection->containsKey($key);
    }

    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     * @param string|int $key .
     *
     * @return mixed|null.
     */
    public function remove($key)
    {
        return $this->collection->remove($key);
    }

    /**
     * @param mixed $element
     *
     * @return bool
     */
    public function removeElement($element): bool
    {
        return $this->collection->removeElement($element);
    }

    /**
     * @param string|int $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->collection->first();
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return $this->collection->last();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->collection->current();
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return $this->collection->next();
    }

    public function exists(Closure $existsAssertionFunction): bool
    {
        return $this->collection->exists($existsAssertionFunction);
    }
}
