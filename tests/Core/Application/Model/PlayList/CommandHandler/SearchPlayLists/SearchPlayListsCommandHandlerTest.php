<?php

namespace Test\Core\Application\Model\PlayList\CommandHandler\SearchPlayLists;

use Core\Application\Model\PlayList\CommandHandler\SearchPlayLists\SearchPlayListsCommand;
use Core\Application\Model\PlayList\CommandHandler\SearchPlayLists\SearchPlayListsCommandHandler;
use Core\Application\Model\PlayList\CommandHandler\SearchPlayLists\SearchPlayListsCommandResult;
use Core\Application\Model\PlayList\Resource\PlayListResource;
use Core\Domain\Model\PlayList\PlayListRepository;
use PHPUnit\Framework\TestCase;
use SharedKernel\Application\Command\CommandResult;
use SharedKernel\Application\Exception\ApplicationEntityNotFoundException;
use SharedKernel\Common\Collection\ArrayCollection;
use Test\Core\Domain\Model\PlayList\FakePlayListBuilder;

class SearchPlayListsCommandHandlerTest extends TestCase
{
    /**
     * @var PlayListRepository
     */
    private $playListRepository;

    protected function setUp()
    {
        $this->playListRepository = $this->prophesize(PlayListRepository::class);
    }

    /**
     * Given:         ASearchPlayListsCommand
     * ItShould:      GetAllTracks
     * AndTheyShould: BeTransformedToResources
     * @test
     */
    public function givenASearchPlayListsCommandItShouldGetAllTracksAndTheyShouldBeTransformedToResources()
    {
        $this->playListRepository
            ->findAll()
            ->willReturn(ArrayCollection::createFromArray([FakePlayListBuilder::build()]));

        $commandResult = $this->handle(SearchPlayListsCommand::instance());

        $this->assertInstanceOf(PlayListResource::class, $this->getFirstPlayList($commandResult));
    }

    /**
     * @param SearchPlayListsCommand $searchPlayListsCommand
     *
     * @return CommandResult|SearchPlayListsCommandResult
     * @throws ApplicationEntityNotFoundException
     */
    private function handle(SearchPlayListsCommand $searchPlayListsCommand): SearchPlayListsCommandResult
    {
        return $this->buildCommandHandler()->handle($searchPlayListsCommand);
    }

    private function buildCommandHandler(): SearchPlayListsCommandHandler
    {
        return new SearchPlayListsCommandHandler(
            $this->playListRepository->reveal()
        );
    }

    private function getFirstPlayList(SearchPlayListsCommandResult $commandResult): PlayListResource
    {
        $playLists = $commandResult->playListResources();

        return $playLists->first();
    }
}
