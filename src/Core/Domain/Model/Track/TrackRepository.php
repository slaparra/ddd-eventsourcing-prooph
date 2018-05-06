<?php

namespace Core\Domain\Model\Track;

use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Repository\EntityRepository;

interface TrackRepository extends EntityRepository
{
    const SIZE = 20;

    /**
     * @param TrackId $id
     * @return Track
     * @throws TrackNotFoundException
     */
    public function findOrFail(TrackId $id): Track;

    public function find(TrackId $id): ?Track;

    public function findByCriteria(TrackCriteria $criteria): Collection;

    public function save(Track $track): void;
}
