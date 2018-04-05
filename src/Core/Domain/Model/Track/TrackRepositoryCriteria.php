<?php

namespace Core\Domain\Model\Track;

class TrackRepositoryCriteria
{
    /**
     * @var int
     */
    private $page;

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
     * @var array
     */
    private $order;

    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $from;

    /**
     * @var string
     */
    private $albumId;

    private function __construct(
        string $albumId = null,
        string $albumTitle = null,
        string $trackName = null,
        string $composer = null,
        int $page = 1,
        array $order = ['id' => 'asc'],
        int $size = TrackRepository::SIZE,
        int $from = 1
    ) {
        $this->albumId = $albumId;
        $this->albumTitle = $albumTitle;
        $this->trackName = $trackName;
        $this->composer = $composer;
        $this->page = $page;
        $this->order = $order;
        $this->size = $size;
        $this->from = $from;
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
    ): TrackRepositoryCriteria {
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

    public function page(): int
    {
        return $this->page;
    }

    public function order(): array
    {
        return $this->order;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function from(): int
    {
        return $this->from;
    }
}
