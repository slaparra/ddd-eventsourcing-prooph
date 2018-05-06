<?php

namespace Core\Domain\Model\Album;

use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Collection\ArrayCollection;

class AlbumIdCollection extends ArrayCollection
{
    protected function __construct(array $trackIds)
    {
        Assertion::allIsInstanceOf($trackIds, AlbumId::class);
        parent::__construct($trackIds);
    }
}
