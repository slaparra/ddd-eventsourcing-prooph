<?php

namespace Core\Application\Model\Track\CommandHandler\SearchTracks;

use Core\Application\Model\Track\Resource\TrackResource;
use SharedKernel\Application\Command\CommandResult;

class SearchTracksCommandResult implements CommandResult
{
    /**
     * @var TrackResource[]
     */
    private $trackResources;

    /**
     * @param TrackResource[] $trackResources
     */
    private function __construct(array $trackResources)
    {
        $this->trackResources = $trackResources;
    }

    /**
     * @param TrackResource[] $trackResources
     *
     * @return SearchTracksCommandResult
     */
    public static function instance(array $trackResources): SearchTracksCommandResult
    {
        return new static($trackResources);
    }

    /**
     * @return TrackResource[]
     */
    public function trackResources(): array
    {
        return $this->trackResources;
    }
}
