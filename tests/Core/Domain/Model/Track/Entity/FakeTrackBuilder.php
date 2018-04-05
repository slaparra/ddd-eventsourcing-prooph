<?php

namespace Test\Core\Domain\Model\Track\Entity;

use Core\Domain\Model\Album\Album;
use Core\Domain\Model\Track\Genre;
use Core\Domain\Model\Track\MediaType;
use Core\Domain\Model\Track\Track;
use Core\Domain\Model\Track\TrackId;
use Test\Core\Domain\Model\Album\FakeAlbumBuilder;

class FakeTrackBuilder
{
    const FAKE_ID = '3079b74c-ce81-4fd1-b2e8-f86084944f7e';
    const FAKE_NAME = 'track name';
    const FAKE_COMPOSER = 'a composer';

    public static function build(TrackId $id = null, string $name = self::FAKE_NAME, Album $album = null)
    {
        $trackId = $id ?? TrackId::fromString(self::FAKE_ID);
        $album = $album ?? FakeAlbumBuilder::build();

        $mediaType = MediaType::fromString(MediaType::AAC_AUDIO_FILE);
        $genre = Genre::create(Genre::ALTERNATIVE);
        $composer = 'fake composer';
        $milliseconds = 343;
        $bytes = 32;
        $unitPrice = 12.00;

        return Track::create($trackId, $name, $album, $mediaType, $genre, $composer, $milliseconds, $bytes, $unitPrice);
    }
}
