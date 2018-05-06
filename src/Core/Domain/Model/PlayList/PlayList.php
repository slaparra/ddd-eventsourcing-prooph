<?php

namespace Core\Domain\Model\PlayList;

use Core\Domain\Model\Track\TrackIdCollection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Track\Track;

class PlayList extends AggregateRoot
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TrackIdCollection
     */
    private $trackIds;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    protected function __construct(PlayListId $id, string $name)
    {
        parent::__construct($id);
        $this->trackIds = TrackIdCollection::createEmpty();
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
        $this->trackIds->add($track->id());
    }

    public function removeTrack(Track $track): void
    {
        $this->trackIds->removeElement($track->id());
    }

    public function trackIds(): TrackIdCollection
    {
        return $this->trackIds;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function countOfTracks(): int
    {
        return $this->trackIds->count();
    }
}
