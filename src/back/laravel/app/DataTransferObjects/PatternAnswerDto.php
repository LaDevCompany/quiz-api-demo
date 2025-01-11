<?php

namespace App\DataTransferObjects;

readonly class PatternAnswerDto
{
    protected function __construct(
        public string $id,
        public string $title,
        public string $pattern,
    ) {}

    public static function create(
        string $id,
        array $title,
        array $pattern,
    ): static {
        return new static(
            $id,
            $title[config('services.quiz-api.preferred_lang')],
            $pattern[config('services.quiz-api.preferred_lang')]
        );
    }

    public static function fromArray(array $data): static
    {
        return self::create(
            id: $data['id'],
            title: $data['title'],
            pattern: $data['pattern'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'pattern' => $this->pattern,
        ];
    }
}
