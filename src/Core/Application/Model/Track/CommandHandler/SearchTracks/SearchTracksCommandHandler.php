<?php

namespace Core\Application\Model\Track\CommandHandler\SearchTracks;

use Core\Application\Model\Track\Resource\TrackResource;
use Core\Domain\Model\Track\Track;
use SharedKernel\Application\Command\Command;
use SharedKernel\Application\Command\CommandHandler;
use Core\Domain\Model\Track\TrackRepository;
use Core\Domain\Model\Track\TrackRepositoryCriteria;
use SharedKernel\Application\Command\CommandResult;

class SearchTracksCommandHandler extends CommandHandler
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
     * @param Command|SearchTracksCommand $command
     * @return CommandResult
     */
    protected function doHandle(Command $command): CommandResult
    {
        $from = ($command->page() - 1) * TrackRepository::SIZE;

        $trackCollection = $this->trackRepository->findByCriteria(
            TrackRepositoryCriteria::instance(
                $command->albumId(),
                $command->albumTitle(),
                $command->trackName(),
                $command->composer(),
                $command->page(),
                ['id' => 'asc'],
                TrackRepository::SIZE,
                $from
            )
        );

        return SearchTracksCommandResult::instance(
            $trackCollection
                ->map($this->transformTrackToTrackResourceClosure())
                ->toArray()
        );
    }

    /**
     * @return \Closure
     */
    protected function transformTrackToTrackResourceClosure(): \Closure
    {
        return function (Track $track) {
            return TrackResource::fromTrack($track);
        };
    }
}
