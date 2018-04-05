<?php

namespace Core\Application\Model\Track\CommandHandler\SearchTracks;

use SharedKernel\Application\Command\Command;

class SearchTracksCommand implements Command
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

    /**
     * @var int
     */
    private $page;

    private function __construct(
        ?string $albumTitle,
        ?string $trackName,
        ?string $composer,
        ?string $albumId,
        int $page = 1
    ) {
        $this->albumTitle = $albumTitle;
        $this->trackName = $trackName;
        $this->composer = $composer;
        $this->albumId = $albumId;
        $this->page = $page;
    }

    public static function instance(
        ?string $albumTitle,
        ?string $trackName,
        ?string $composer,
        ?string $albumId,
        int $page = 1
    ): SearchTracksCommand {
        return new static($albumTitle, $trackName, $composer, $albumId, $page);
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

    public function albumId(): ?string
    {
        return $this->albumId;
    }

    public function page(): int
    {
        return $this->page;
    }
}
