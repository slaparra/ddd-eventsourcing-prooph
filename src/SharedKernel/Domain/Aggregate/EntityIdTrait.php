<?php

namespace SharedKernel\Domain\Aggregate;

use SharedKernel\Common\Uuid;

trait EntityIdTrait
{
    /**
     * @var Uuid
     */
    private $id;

    private function setId(Uuid $id)
    {
        $this->id = $id;
    }

    public function id(): Uuid
    {
        return $this->id;
    }
}
