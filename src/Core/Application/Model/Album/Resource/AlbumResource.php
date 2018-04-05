<?php

namespace Core\Application\Model\Album\Resource;

use Core\Domain\Model\Album\Album;

class AlbumResource
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    private function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public static function fromAlbum(Album $album): AlbumResource
    {
        return new static($album->id()->toString(), $album->title());
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
}
