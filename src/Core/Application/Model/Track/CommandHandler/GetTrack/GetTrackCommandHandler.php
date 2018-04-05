<?php

namespace Core\Application\Model\Track\CommandHandler\GetTrack;

use Core\Application\Model\Track\Resource\TrackResource;
use Core\Domain\Model\Track\TrackId;
use Core\Domain\Model\Track\TrackNotFoundException;
use SharedKernel\Application\Command\Command;
use SharedKernel\Application\Command\CommandHandler;
use Core\Domain\Model\Track\TrackRepository;
use SharedKernel\Application\Command\CommandResult;

class GetTrackCommandHandler extends CommandHandler
{
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    public function __construct(TrackRepository $trackRepository)
    {
        $this->trackRepository = $trackRepository;
    }

    /**
     * @param Command|GetTrackCommand $command
     *
     * @return CommandResult|GetTrackCommandResult
     * @throws TrackNotFoundException
     */
    protected function doHandle(Command $command): CommandResult
    {
        $track = $this->trackRepository->findOrFail(TrackId::fromString($command->trackId()));

        return GetTrackCommandResult::instance(
            TrackResource::fromTrack($track)
        );
    }
}
