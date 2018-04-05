<?php

namespace Core\Application\Model\Track\CommandHandler\CreateTrack;

use SharedKernel\Application\Command\Command;

class CreateTrackCommand implements Command
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
     * @var string
     */
    private $albumId;

    /**
     * @var string
     */
    private $mediaTypeId;

    /**
     * @var string
     */
    private $genreId;

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

    private function __construct(
        string $id,
        string $name,
        string $albumId,
        string $mediaTypeId,
        int $genreId,
        string $composer,
        int $milliseconds,
        int $bytes,
        float $unitPrice
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->albumId = $albumId;
        $this->mediaTypeId = $mediaTypeId;
        $this->genreId = $genreId;
        $this->composer = $composer;
        $this->milliseconds = $milliseconds;
        $this->bytes = $bytes;
        $this->unitPrice = $unitPrice;
    }

    public static function instance(
        string $id,
        string $name,
        string $albumId,
        string $mediaTypeId,
        int $genreId,
        string $composer,
        int $milliseconds,
        int $bytes,
        float $unitPrice
    ): CreateTrackCommand {
        return new static(
            $id,
            $name,
            $albumId,
            $mediaTypeId,
            $genreId,
            $composer,
            $milliseconds,
            $bytes,
            $unitPrice
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

    public function albumId(): string
    {
        return $this->albumId;
    }

    public function mediaTypeId(): string
    {
        return $this->mediaTypeId;
    }

    public function genreId(): int
    {
        return $this->genreId;
    }

    public function composer(): string
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

    public function unitPrice(): float
    {
        return $this->unitPrice;
    }
}
