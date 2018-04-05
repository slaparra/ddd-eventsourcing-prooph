<?php

namespace Core\Domain\Model\PlayList;

use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Track\Track;

class PlayList extends AggregateRoot
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $tracks;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    protected function __construct(PlayListId $id, string $name)
    {
        parent::__construct($id);
        $this->tracks = ArrayCollection::createEmpty();
        $this->name = $name;
    }

    public static function create(PlayListId $id, string $name): PlayList
    {
        return new static($id, $name);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addTrack(Track $track): void
    {
        $this->tracks->add($track);
    }

    public function removeTrack(Track $track): void
    {
        $this->tracks->removeElement($track);
    }

    /**
     * @return Collection|Track[]
     */
    public function tracks(): Collection
    {
        return $this->tracks;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function countOfTracks(): int
    {
        return $this->tracks->count();
    }
}
