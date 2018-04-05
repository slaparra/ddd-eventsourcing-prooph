<?php

namespace Core\Domain\Model\Album;

use SharedKernel\Domain\Repository\EntityRepository;

interface AlbumRepository extends EntityRepository
{
    public function find(AlbumId $id): ?Album;

    /**
     * @param AlbumId $id
     * @return Album
     * @throws AlbumNotFoundException
     */
    public function findOrFail(AlbumId $id): Album;
}
