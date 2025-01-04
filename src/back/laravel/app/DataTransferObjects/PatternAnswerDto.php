<?php

namespace App\DataTransferObjects;

readonly class PatternAnswerDto
{
    protected function __construct(
        public string $id,
        public string $pattern,
    ) {}

    public static function create(
        string $id,
        array $pattern,
    ): static {
        return new static(
            $id,
            $pattern[config('services.quiz-api.preferred_lang')]
        );
    }

    public static function fromArray(array $data): static
    {
        return self::create(
            id: $data['id'],
            pattern: $data['pattern'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'pattern' => $this->pattern,
        ];
    }
}
