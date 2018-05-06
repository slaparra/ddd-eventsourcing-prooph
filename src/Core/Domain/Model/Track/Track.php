<?php

namespace Core\Domain\Model\Track;

use Core\Domain\Model\Album\AlbumId;
use Core\Domain\Model\Invoice\InvoiceLine;
use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Album\Album;
use Core\Domain\Model\PlayList\PlayList;

class Track extends AggregateRoot
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var AlbumId
     */
    private $albumId;

    /**
     * @var MediaType
     */
    private $mediaType;

    /**
     * @var Genre
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
     * @var float
     */
    private $unitPrice;

    /**
     * @var Collection
     */
    private $invoiceLines;

    /**
     * @var Collection
     */
    private $playLists;

    protected function __construct(
        TrackId $trackId,
        string $name,
        Album $album,
        MediaType $mediaType,
        Genre $genre,
        string $composer,
        int $milliseconds,
        int $bytes,
        float $unitPrice
    ) {
        parent::__construct($trackId);
        $this->invoiceLines = ArrayCollection::createEmpty();
        $this->playLists = ArrayCollection::createEmpty();
        $this->name = $name;
        $this->albumId = $album->id();
        $this->mediaType = $mediaType;
        $this->genre = $genre;
        $this->composer = $composer;
        $this->milliseconds = $milliseconds;
        $this->bytes = $bytes;
        $this->unitPrice = $unitPrice;

        //@todo missing event
    }

    public static function create(
        TrackId $trackId,
        string $name,
        Album $album,
        MediaType $mediaType,
        Genre $genre,
        string $composer,
        int $milliseconds,
        int $bytes,
        float $unitPrice
    ): Track {
        return new static($trackId, $name, $album, $mediaType, $genre, $composer, $milliseconds, $bytes, $unitPrice);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function albumId(): AlbumId
    {
        return $this->albumId;
    }

    public function mediaType(): MediaType
    {
        return $this->mediaType;
    }

    public function genre(): Genre
    {
        return $this->genre;
    }

    public function composer(): ?string
    {
        return $this->composer;
    }

    public function milliseconds(): ?int
    {
        return $this->milliseconds;
    }

    public function bytes(): ?int
    {
        return $this->bytes;
    }

    public function unitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function invoiceLines(): Collection
    {
        return $this->invoiceLines;
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine): void
    {
        $this->invoiceLines->add($invoiceLine);
    }

    public function removeInvoiceLine(InvoiceLine $invoiceLine)
    {
        $this->invoiceLines->removeElement($invoiceLine);
    }

    public function playLists(): Collection
    {
        return $this->playLists;
    }

    public function addPlayList(PlayList $playList): void
    {
        $this->playLists->add($playList);
    }

    public function removePlayList(PlayList $playList): void
    {
        $this->playLists->removeElement($playList);
    }
}
