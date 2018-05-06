<?php

namespace SharedKernel\Domain\Repository;

class Criteria
{
    const DEFAULT_SIZE = 20;

    /**
     * @var int
     */
    private $page;

    /**
     * @var array
     */
    private $order;

    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $from;

    protected function __construct(
        int $page = 1,
        array $order = ['id' => 'asc'],
        int $size = self::DEFAULT_SIZE,
        int $from = 1
    ) {
        $this->page = $page;
        $this->order = $order;
        $this->size = $size;
        $this->from = $from;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function order(): array
    {
        return $this->order;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function from(): int
    {
        return $this->from;
    }
}
