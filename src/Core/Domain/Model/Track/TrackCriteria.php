<?php

namespace Core\Domain\Model\Track;

use SharedKernel\Domain\Repository\Criteria;

class TrackCriteria extends Criteria
{
    /**
     * @var string
     */
    private $albumTitle;

    /**
     * @var string
     */
    private $trackName;

    /**
     * @var string
     */
    private $composer;

    /**
     * @var string
     */
    private $albumId;

    protected function __construct(
        string $albumId = null,
        string $albumTitle = null,
        string $trackName = null,
        string $composer = null,
        int $page = 1,
        array $order = ['name' => 'asc'],
        int $size = TrackRepository::SIZE,
        int $from = 1
    ) {
        parent::__construct($page, $order, $size, $from);
        $this->albumId = $albumId;
        $this->albumTitle = $albumTitle;
        $this->trackName = $trackName;
        $this->composer = $composer;
    }

    public static function instance(
        string $albumId = null,
        string $albumTitle = null,
        string $trackName = null,
        string $composer = null,
        int $page = 1,
        array $order = ['name' => 'asc'],
        int $size = TrackRepository::SIZE,
        int $from = 1
    ): TrackCriteria {
        return new static($albumId, $albumTitle, $trackName, $composer, $page, $order, $size, $from);
    }

    public function albumId(): ?string
    {
        return $this->albumId;
    }

    public function albumTitle(): ?string
    {
        return $this->albumTitle;
    }

    public function trackName(): ?string
    {
        return $this->trackName;
    }

    public function composer(): ?string
    {
        return $this->composer;
    }
}
