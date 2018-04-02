<?php

namespace SharedKernel\Domain\Exception;

use SharedKernel\Common\Uuid;

abstract class EntityNotFoundException extends DomainException
{
    public static function withId(Uuid $id)
    {
        return new static(
            sprintf("Entity with id %s: %s not found", get_class($id), $id->toString())
        );
    }
}
