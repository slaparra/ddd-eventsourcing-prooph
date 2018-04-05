<?php

namespace Test\Core\Application\Model\Track\CommandHandler\GetTrack;

use Core\Application\Model\Track\CommandHandler\GetTrack\GetTrackCommand;
use Core\Application\Model\Track\CommandHandler\GetTrack\GetTrackCommandHandler;
use Core\Application\Model\Track\CommandHandler\GetTrack\GetTrackCommandResult;
use Core\Application\Model\Track\Resource\TrackResource;
use Core\Domain\Model\Track\TrackId;
use Core\Domain\Model\Track\TrackNotFoundException;
use Core\Domain\Model\Track\TrackRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use SharedKernel\Application\Exception\ApplicationEntityNotFoundException;
use Test\Core\Domain\Model\Track\Entity\FakeTrackBuilder;

class GetTrackCommandHandlerTest extends TestCase
{
    const FAKE_TRACK_ID = '18c6ca3c-2b6a-4091-bd26-5d8b9bea1244';

    /**
     * @var TrackRepository
     */
    private $trackRepository;

    protected function setUp()
    {
        $this->trackRepository = $this->prophesize(TrackRepository::class);
    }

    /**
     * @test
     */
    public function itShouldThrowApplicationEntityNotFoundExceptionWhenNotTrackFoundExceptionIsThrown()
    {
        $this->expectException(ApplicationEntityNotFoundException::class);

        $this->trackRepository
            ->findOrFail(Argument::any())
            ->willThrow(TrackNotFoundException::withId(TrackId::fromString(self::FAKE_TRACK_ID)));

        $this->buildGetTrackCommandHandler()
            ->handle(GetTrackCommand::instance(self::FAKE_TRACK_ID));
    }

    /**
     * @test
     */
    public function itShouldReturnATrackResourceWhenTrackIdExists()
    {
        $commandHandler = $this->buildGetTrackCommandHandler();

        $this->trackRepository
            ->findOrFail(Argument::exact(TrackId::fromString(self::FAKE_TRACK_ID)))
            ->willReturn(FakeTrackBuilder::build(TrackId::fromString(self::FAKE_TRACK_ID)));

        /** @var GetTrackCommandResult $result */
        $result = $commandHandler->handle(GetTrackCommand::instance(self::FAKE_TRACK_ID));

        $this->assertInstanceOf(TrackResource::class, $result->trackResource());
    }

    private function buildGetTrackCommandHandler(): GetTrackCommandHandler
    {
        return new GetTrackCommandHandler(
            $this->trackRepository->reveal()
        );
    }
}
