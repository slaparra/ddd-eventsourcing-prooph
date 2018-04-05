<?php

namespace Core\Application\Model\PlayList\CommandHandler\SearchPlayLists;

use Core\Application\Model\PlayList\Resource\PlayListResource;
use SharedKernel\Application\Command\CommandResult;
use SharedKernel\Common\Collection\Collection;

class SearchPlayListsCommandResult implements CommandResult
{
    /**
     * @var Collection|PlayListResource[]
     */
    private $playListResources;

    /**
     * @param Collection|PlayListResource[] $playListResources
     */
    private function __construct(Collection $playListResources)
    {
        $this->playListResources = $playListResources;
    }

    /**
     * @param Collection|PlayListResource[] $playListResources
     *
     * @return SearchPlayListsCommandResult
     */
    public static function instance(Collection $playListResources): SearchPlayListsCommandResult
    {
        return new static($playListResources);
    }

    /**
     * @return Collection|PlayListResource[]
     */
    public function playListResources(): Collection
    {
        return $this->playListResources;
    }
}
