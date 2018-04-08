<?php

namespace Core\Application\Model\Track\CommandHandler\CreateTrack;

use Core\Domain\Model\Album\AlbumId;
use Core\Domain\Model\Album\AlbumNotFoundException;
use Core\Domain\Model\Track\Genre;
use Core\Domain\Model\Track\MediaType;
use Core\Domain\Model\Track\TrackId;
use SharedKernel\Application\Command\Command;
use SharedKernel\Application\Command\CommandHandler;
use Core\Domain\Model\Album\AlbumRepository;
use Core\Domain\Model\Track\Track;
use Core\Domain\Model\Track\TrackRepository;
use SharedKernel\Application\Command\CommandResult;
use SharedKernel\Application\Command\NullCommandResult;

class CreateTrackCommandHandler extends CommandHandler
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    /**
     * @var TrackRepository
     */
    private $trackRepository;

    public function __construct(
        AlbumRepository $albumRepository,
        TrackRepository $trackRepository
    ) {
        $this->albumRepository = $albumRepository;
        $this->trackRepository = $trackRepository;
    }

    /**
     * @param Command|CreateTrackCommand $command
     *
     * @return NullCommandResult
     * @throws AlbumNotFoundException
     */
    protected function doHandle(Command $command): CommandResult
    {
        $album = $this->albumRepository->findOrFail(AlbumId::fromString($command->albumId()));

        $track = Track::create(
            TrackId::fromString($command->id()),
            $command->name(),
            $album,
            MediaType::fromString($command->mediaTypeId()),
            Genre::create($command->genreId()),
            $command->composer(),
            $command->milliseconds(),
            $command->bytes(),
            $command->unitPrice()
        );

        $this->trackRepository->save($track);

        return NullCommandResult::instance();
    }
}
