<?php

namespace SharedKernel\Application\Exception;

use Throwable;

class ApplicationException extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
