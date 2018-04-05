<?php

namespace Core\Application\Model\Track\Resource;

use Core\Application\Model\Album\Resource\AlbumResource;
use Core\Domain\Model\Track\Track;

class TrackResource
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var AlbumResource
     */
    private $albumResource;

    /**
     * @var string
     */
    private $mediaType;

    /**
     * @var int
     */
    private $genre;

    /**
     * @var string
     */
    private $composer;

    /**
     * @var int
     */
    private $milliseconds;

    /**
     * @var int
     */
    private $bytes;

    /**
     * @var string
     */
    private $unitPrice;

    private function __construct(
        string $id,
        string $name,
        AlbumResource $albumResource,
        string $mediaType,
        int $genre,
        string $composer,
        int $milliseconds,
        int $bytes,
        float $unitPrice
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->albumResource = $albumResource;
        $this->mediaType = $mediaType;
        $this->genre = $genre;
        $this->composer = $composer;
        $this->milliseconds = $milliseconds;
        $this->bytes = $bytes;
        $this->unitPrice = $unitPrice;
    }

    public static function fromTrack(Track $track): TrackResource
    {
        return new static(
            $track->id()->toString(),
            $track->name(),
            AlbumResource::fromAlbum($track->album()),
            $track->mediaType()->value(),
            $track->genre()->value(),
            $track->composer(),
            $track->milliseconds(),
            $track->bytes(),
            $track->unitPrice()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function albumResource(): AlbumResource
    {
        return $this->albumResource;
    }

    public function mediaType(): string
    {
        return $this->mediaType;
    }

    public function genre(): int
    {
        return $this->genre;
    }

    public function composer(): ?string
    {
        return $this->composer;
    }

    public function milliseconds(): int
    {
        return $this->milliseconds;
    }

    public function bytes(): int
    {
        return $this->bytes;
    }

    public function unitPrice(): string
    {
        return $this->unitPrice;
    }
}
