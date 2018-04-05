<?php

namespace Core\Application\Model\PlayList\Resource;

use Core\Domain\Model\PlayList\PlayList;
use Core\Domain\Model\PlayList\PlayListId;

class PlayListResource
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    private function __construct(PlayListId $id, string $name)
    {
        $this->id = $id->toString();
        $this->name = $name;
    }

    public static function fromPlayList(PlayList $playList): PlayListResource
    {
        return new static($playList->id(), $playList->name());
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
