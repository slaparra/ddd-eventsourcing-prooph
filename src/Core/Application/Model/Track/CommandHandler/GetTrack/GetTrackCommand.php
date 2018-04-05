<?php

namespace Core\Application\Model\Track\CommandHandler\GetTrack;

use SharedKernel\Application\Command\Command;

class GetTrackCommand implements Command
{
    /**
     * @var string
     */
    private $trackId;

    private function __construct(string $trackId)
    {
        $this->trackId = $trackId;
    }

    public static function instance(string $trackId): GetTrackCommand
    {
        return new static($trackId);
    }

    public function trackId(): string
    {
        return $this->trackId;
    }
}
