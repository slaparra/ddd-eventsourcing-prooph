<?php

namespace Core\Domain\Model\Track;

use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Collection\ArrayCollection;

class TrackIdCollection extends ArrayCollection
{
    protected function __construct(array $trackIds)
    {
        Assertion::allIsInstanceOf($trackIds, TrackId::class);
        parent::__construct($trackIds);
    }
}
