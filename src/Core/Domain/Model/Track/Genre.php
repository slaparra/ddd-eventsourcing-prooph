<?php

namespace Core\Domain\Model\Track;

class Genre
{
    const ROCK = 1;
    const JAZZ = 2;
    const METAL = 3;
    const ALTERNATIVE_AND_PUNK = 4;
    const ROCK_AND_ROLL = 5;
    const BLUES = 6;
    const LATIN = 7;
    const REGGAE = 8;
    const POP = 9;
    const SOUNDTRACK = 10;
    const BOSSA_NOVA = 11;
    const EASY_LISTENING = 12;
    const HEAVY_METAL = 13;
    const RB_SOUL = 14;
    const ELECTRONICA_DANCE = 15;
    const WORLD = 16;
    const HIP_HOP_RAP = 17;
    const SCIENCE_FICTION = 18;
    const TV_SHOWS = 19;
    const SCI_FI_AND_FANTASY = 20;
    const DRAMA = 21;
    const COMEDY = 22;
    const ALTERNATIVE = 23;
    const CLASSICAL = 24;
    const OPERA = 25;

    /**
     * @var integer
     */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): Genre
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
