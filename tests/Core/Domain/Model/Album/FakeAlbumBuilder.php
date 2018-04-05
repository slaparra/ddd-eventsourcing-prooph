<?php

namespace Test\Core\Domain\Model\Album;

use Core\Domain\Model\Album\Album;
use Core\Domain\Model\Album\AlbumId;

class FakeAlbumBuilder
{
    const FAKE_ID = '46852687-8dd1-4059-9748-22106f58c28a';
    const DEFAULT_TITLE = 'default title';

    public static function build(AlbumId $id = null, string $title = self::DEFAULT_TITLE)
    {
        $albumId = $id ?? AlbumId::fromString(self::FAKE_ID);

        return Album::create($albumId, $title);
    }
}
