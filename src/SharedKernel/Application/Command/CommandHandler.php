<?php

namespace SharedKernel\Application\Command;

use SharedKernel\Application\Exception\ApplicationEntityNotFoundException;
use SharedKernel\Domain\Exception\EntityNotFoundException as DomainEntityNotFoundException;

abstract class CommandHandler
{
    public function handle(Command $command): CommandResult
    {
        try {
            return $this->doHandle($command);
        } catch (DomainEntityNotFoundException $e) {
            throw new ApplicationEntityNotFoundException($e->getMessage(), $e);
        }
    }

    abstract protected function doHandle(Command $command): CommandResult;
}
