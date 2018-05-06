<?php

namespace Test\Core\Application\Model\Track\CommandHandler\SearchTracks;

use Core\Application\Model\Track\CommandHandler\SearchTracks\SearchTracksCommand;
use Core\Application\Model\Track\CommandHandler\SearchTracks\SearchTracksCommandHandler;
use Core\Application\Model\Track\CommandHandler\SearchTracks\SearchTracksCommandResult;
use Core\Application\Model\Track\Resource\TrackResource;
use Core\Domain\Model\Track\TrackRepository;
use Core\Domain\Model\Track\TrackCriteria;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use SharedKernel\Common\Collection\ArrayCollection;
use Test\Core\Domain\Model\Album\FakeAlbumBuilder;
use Test\Core\Domain\Model\Track\Entity\FakeTrackBuilder;

class SearchTracksCommandHandlerTest extends TestCase
{
    const ANY_PAGE_NUMBER = 3;

    /**
     * @var TrackRepository | ObjectProphecy
     */
    private $trackRepository;

    protected function setUp()
    {
        $this->trackRepository = $this->prophesize(TrackRepository::class);
    }

    /**
     * Given:    ASearchTracksCommand
     * ItShould: BuildATrackRepositoryCriteria
     * @test
     */
    public function givenASearchTracksCommandItShouldBuildATrackRepositoryCriteria()
    {
        $command = SearchTracksCommand::instance(
            'an album title',
            'a track name',
            'a composer',
            FakeAlbumBuilder::FAKE_ID,
            self::ANY_PAGE_NUMBER
        );

        $this->trackRepository
            ->findByCriteria(
                Argument::that($this->assertTrackRepositoryCriteriaIsBuiltWithProperValues($command))
            )
            ->shouldBeCalledTimes(1)
            ->willReturn(ArrayCollection::createEmpty());

        $this->searchTracksCommandHandlerInstance()->handle($command);
    }

    /**
     * Given: ASearchTracksCommand
     * When:  SomeTracksAreFound
     * Then:  TheyShouldBeMappedToTrackResources
     * @test
     */
    public function givenACommandWhenSomeTracksAreFoundThenTheyShouldBeMappedToTrackResources()
    {
        $command = SearchTracksCommand::instance(
            'an album title',
            'a track name',
            'a composer',
            FakeAlbumBuilder::FAKE_ID,
            self::ANY_PAGE_NUMBER
        );

        $this->trackRepository
            ->findByCriteria(Argument::any())
            ->shouldBeCalledTimes(1)
            ->willReturn(ArrayCollection::createFromArray([FakeTrackBuilder::build()]));

        /** @var SearchTracksCommandResult $result */
        $result = $this->searchTracksCommandHandlerInstance()->handle($command);
        $firstElement = $result->trackResources()[0];

        $this->assertContainsOnlyInstancesOf(TrackResource::class, $result->trackResources());
        $this->assertEquals($firstElement->id(), FakeTrackBuilder::FAKE_ID);
    }

    private function searchTracksCommandHandlerInstance(): SearchTracksCommandHandler
    {
        return new SearchTracksCommandHandler(
            $this->trackRepository->reveal()
        );
    }

    private function assertTrackRepositoryCriteriaIsBuiltWithProperValues(SearchTracksCommand $command): \Closure
    {
        return function (TrackCriteria $trackRepositoryCriteria) use ($command) {
            return $trackRepositoryCriteria->albumTitle() === $command->albumTitle()
                   && $trackRepositoryCriteria->trackName() === $command->trackName()
                   && $trackRepositoryCriteria->composer() === $command->composer()
                   && $trackRepositoryCriteria->albumId() === $command->albumId()
                   && $trackRepositoryCriteria->page() === $command->page();
        };
    }
}
