<?php

namespace Core\Domain\Model\Track;

class MediaType
{
    const MPEG_AUDIO_FILE = 'MPEG_AUDIO_FILE';
    const PROTECTED_AAC_AUDIO_FILE = 'PROTECTED_AAC_AUDIO_FILE';
    const PROTECTED_MPEG4_VIDEO_FILE = 'PROTECTED_MPEG4_VIDEO_FILE';
    const PURCHASED_AAC_AUDIO_FILE = 'PURCHASED_AAC_AUDIO_FILE';
    const AAC_AUDIO_FILE = 'AAC_AUDIO_FILE';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $value): MediaType
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
