<?php

namespace Core\Domain\Model\Artist;

use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Album\Album;

class Artist extends AggregateRoot
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $albums;

    public function __construct(ArtistId $id, string $name)
    {
        parent::__construct($id);
        $this->albums = ArrayCollection::createEmpty();
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
        $this->albums->add($album);
    }

    public function removeAlbum(Album $album): void
    {
        $this->albums->removeElement($album);
    }

    public function albums(): Collection
    {
        return $this->albums;
    }
}
