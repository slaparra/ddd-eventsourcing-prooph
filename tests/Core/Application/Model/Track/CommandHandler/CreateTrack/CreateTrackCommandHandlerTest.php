<?php

namespace Test\Core\Application\Model\Track\CommandHandler\CreateTrack;

use Core\Application\Model\Track\CommandHandler\CreateTrack\CreateTrackCommand;
use Core\Application\Model\Track\CommandHandler\CreateTrack\CreateTrackCommandHandler;
use Core\Domain\Model\Album\AlbumId;
use Core\Domain\Model\Album\AlbumNotFoundException;
use Core\Domain\Model\Album\AlbumRepository;
use Core\Domain\Model\Track\Genre;
use Core\Domain\Model\Track\MediaType;
use Core\Domain\Model\Track\Track;
use Core\Domain\Model\Track\TrackRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use SharedKernel\Application\Exception\ApplicationEntityNotFoundException;
use Test\Core\Domain\Model\Album\FakeAlbumBuilder;
use Test\Core\Domain\Model\Track\Entity\FakeTrackBuilder;

class CreateTrackCommandHandlerTest extends TestCase
{
    const MILLISECONDS = 123;
    const BYTES = 444;
    const UNIT_PRICE = 12.25;

    /**
     * @var AlbumRepository | ObjectProphecy
     */
    private $albumRepository;

    /**
     * @var TrackRepository | ObjectProphecy
     */
    private $trackRepository;

    protected function setUp()
    {
        $this->albumRepository = $this->prophesize(AlbumRepository::class);
        $this->trackRepository = $this->prophesize(TrackRepository::class);
    }

    /**
     * Given: ACommand
     * When:  AlbumIsFound
     * Then:  ItShouldBeAssignedToTheTrack
     * @test
     */
    public function givenACommandWhenAlbumIsFoundThenItShouldAssignItToTrack()
    {
        $command = $this->createTrackCommandInstance();

        $this->albumRepository
            ->findOrFail(AlbumId::fromString($command->albumId()))
            ->shouldBeCalledTimes(1)
            ->willReturn(FakeAlbumBuilder::build());

        $this->trackRepository
            ->save(Argument::that($this->assertTheTrackSavedShouldHasTheSamePreviousAlbumFoundClosure($command)))
            ->shouldBeCalledTimes(1);

        $this->buildCreateTrackCommandHandler()->handle($command);
    }

    private function assertTheTrackSavedShouldHasTheSamePreviousAlbumFoundClosure(CreateTrackCommand $command): \Closure
    {
        return function (Track $track) use ($command) {
            return $track->album()->id()->toString() === $command->albumId();
        };
    }

    /**
     * Given: ACommand
     * When:  AlbumIsNotFound
     * Then:  ItShouldThrowApplicationEntityNotFoundException
     * @test
     */
    public function givenACommandWhenAlbumIsNotFoundThenItShouldThrowApplicationEntityNotFoundException()
    {
        $command = $this->createTrackCommandInstance();

        $this->albumRepository
            ->findOrFail(AlbumId::fromString($command->albumId()))
            ->shouldBeCalledTimes(1)
            ->willThrow(AlbumNotFoundException::withId(AlbumId::fromString(FakeAlbumBuilder::FAKE_ID)));

        $this->expectException(ApplicationEntityNotFoundException::class);

        $this->buildCreateTrackCommandHandler()->handle($command);
    }

    /**
     * Given: ACommand
     * When:  TrackIsSaved
     * Then:  ItShouldHasAllTheProperValuesAssigned
     * @test
     */
    public function givenACommandWhenTrackIsSavedThenItShouldHasAllTheProperValuesAssigned()
    {
        $command = $this->createTrackCommandInstance();

        $this->albumRepository
            ->findOrFail(AlbumId::fromString($command->albumId()))
            ->shouldBeCalledTimes(1)
            ->willReturn(FakeAlbumBuilder::build());

        $this->trackRepository
            ->save(Argument::that($this->assertThatTrackHasAllTheValuesProperlyAssigned($command)))
            ->shouldBeCalledTimes(1);

        $this->buildCreateTrackCommandHandler()->handle($command);
    }

    private function assertThatTrackHasAllTheValuesProperlyAssigned(CreateTrackCommand$command): \Closure
    {
        return function (Track $track) use ($command) {
            return $track->id()->toString() === $command->id()
                && $track->name() === $command->name()
                && $track->mediaType()->value() === $command->mediaTypeId()
                && $track->genre()->value() === $command->genreId()
                && $track->composer() === $command->composer()
                && $track->milliseconds() === $command->milliseconds()
                && $track->bytes() === $command->bytes()
                && $track->unitPrice() === $command->unitPrice();
        };
    }

    private function buildCreateTrackCommandHandler(): CreateTrackCommandHandler
    {
        return new CreateTrackCommandHandler(
            $this->albumRepository->reveal(),
            $this->trackRepository->reveal()
        );
    }

    private function createTrackCommandInstance(): CreateTrackCommand
    {
        return CreateTrackCommand::instance(
            FakeTrackBuilder::FAKE_ID,
            FakeTrackBuilder::FAKE_NAME,
            FakeAlbumBuilder::FAKE_ID,
            MediaType::AAC_AUDIO_FILE,
            Genre::ALTERNATIVE,
            FakeTrackBuilder::FAKE_COMPOSER,
            self::MILLISECONDS,
            self::BYTES,
            self::UNIT_PRICE
        );
    }
}
