<?php

namespace Core\Application\Model\PlayList\CommandHandler\SearchPlayLists;

use Core\Application\Model\PlayList\Resource\PlayListResource;
use Core\Domain\Model\PlayList\PlayList;
use SharedKernel\Application\Command\Command;
use SharedKernel\Application\Command\CommandHandler;
use Core\Domain\Model\PlayList\PlayListRepository;
use SharedKernel\Application\Command\CommandResult;

/**
 * This class needs to be improved in order to find playLists by criteria
 */
class SearchPlayListsCommandHandler extends CommandHandler
{
    /**
     * @var PlayListRepository
     */
    private $playListRepository;

    public function __construct(PlayListRepository $playListRepository)
    {
        $this->playListRepository = $playListRepository;
    }

    /**
     * @param Command|SearchPlayListsCommand $command
     *
     * @return CommandResult|SearchPlayListsCommandResult
     */
    protected function doHandle(Command $command): CommandResult
    {
        $playLists = $this->playListRepository->findAll();

        return SearchPlayListsCommandResult::instance(
            $playLists->map($this->transformPlayListToPlayListResourcesClosure())
        );
    }

    private function transformPlayListToPlayListResourcesClosure(): \Closure
    {
        return function (PlayList $playList) {
            return PlayListResource::fromPlayList($playList);
        };
    }
}
