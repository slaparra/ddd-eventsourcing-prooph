<?php

namespace SharedKernel\Domain\Aggregate;

use SharedKernel\Common\Uuid;

abstract class Entity
{
    /**
     * @var Uuid
     */
    private $id;

    protected function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id(): Uuid
    {
        return $this->id;
    }
}
