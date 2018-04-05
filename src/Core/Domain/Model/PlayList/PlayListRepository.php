<?php

namespace Core\Domain\Model\PlayList;

use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Repository\EntityRepository;

interface PlayListRepository extends EntityRepository
{
    public function find(PlayListId $id): ?PlayList;

    /**
     * @return Collection|PlayList[]
     */
    public function findAll(): Collection;

    public function save(PlayList $playList): void;
}
