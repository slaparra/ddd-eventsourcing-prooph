<?php

namespace Core\Application\Model\PlayList\CommandHandler\SearchPlayLists;

use SharedKernel\Application\Command\Command;

class SearchPlayListsCommand implements Command
{
    /**
     * @var int
     */
    private $page;

    private function __construct(int $page = 1)
    {
        $this->page = $page;
    }

    public static function instance(int $page = 1): SearchPlayListsCommand
    {
        return new static($page);
    }

    public function page(): int
    {
        return $this->page;
    }
}
