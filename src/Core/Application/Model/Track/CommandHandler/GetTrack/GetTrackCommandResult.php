<?php

namespace Core\Application\Model\Track\CommandHandler\GetTrack;

use Core\Domain\Model\Track\Track;
use Core\Application\Model\Track\Resource\TrackResource;
use SharedKernel\Application\Command\CommandResult;

class GetTrackCommandResult implements CommandResult
{
    /**
     * @var Track
     */
    private $track;

    private function __construct(TrackResource $track)
    {
        $this->track = $track;
    }

    public static function instance(TrackResource $trackResource): GetTrackCommandResult
    {
        return new static($trackResource);
    }

    public function trackResource(): TrackResource
    {
        return $this->track;
    }
}
