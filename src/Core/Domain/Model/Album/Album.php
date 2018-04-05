<?php

namespace Core\Domain\Model\Album;

use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Artist\Artist;
use Core\Domain\Model\Track\Entity\Track;

class Album extends AggregateRoot
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var Artist
     */
    private $artist;

    /**
     * @var Collection
     */
    private $tracks;

    protected function __construct(AlbumId $id, string $title)
    {
        parent::__construct($id);
        $this->title = $title;
        $this->tracks = ArrayCollection::createEmpty();
    }

    public static function create(AlbumId $id, string $title): Album
    {
        return new static($id, $title);
    }

    public function changeTitle(string $title): void
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function changeArtist(Artist $artist): void
    {
        $this->artist = $artist;
    }

    public function artist(): Artist
    {
        return $this->artist;
    }

    public function addTrack(Track $track): void
    {
        $this->tracks->add($track);
    }

    public function removeTrack(Track $track): void
    {
        $this->tracks->removeElement($track);
    }

    public function tracks(): Collection
    {
        return $this->tracks;
    }
}
