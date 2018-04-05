<?php

namespace Test\Core\Domain\Model\PlayList;

use Core\Domain\Model\PlayList\PlayList;
use Core\Domain\Model\PlayList\PlayListId;
use Test\Core\Domain\Model\Track\Entity\FakeTrackBuilder;

class FakePlayListBuilder
{
    const FAKE_ID = '7007ff33-bdff-45d9-a140-d458d5baf79b';
    const DEFAULT_NAME = 'default playlist name';

    public static function build(PlayListId $id = null, string $name = self::DEFAULT_NAME): PlayList
    {
        $playListId = $id ?? PlayListId::fromString(self::FAKE_ID);
        $playList = PlayList::create($playListId, $name);
        $playList->addTrack(FakeTrackBuilder::build());

        return $playList;
    }
}
