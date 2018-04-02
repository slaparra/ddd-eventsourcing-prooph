<?php

namespace SharedKernel\Application\Command;

class NullCommandResult implements CommandResult
{
    public static function instance()
    {
        return new self();
    }
}
