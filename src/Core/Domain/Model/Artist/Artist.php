<?php

namespace Core\Domain\Model\Artist;

use Core\Domain\Model\Album\AlbumIdCollection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Album\Album;

class Artist extends AggregateRoot
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var AlbumIdCollection
     */
    private $albumIds;

    public function __construct(ArtistId $id, string $name)
    {
        parent::__construct($id);
        $this->albumIds = AlbumIdCollection::createEmpty();
        $this->name = $name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addAlbum(Album $album): void
    {
        $this->albumIds->add($album->id());
    }

    public function removeAlbum(Album $album): void
    {
        $this->albumIds->removeElement($album->id());
    }

    public function albumIds(): AlbumIdCollection
    {
        return $this->albumIds;
    }
}
