<?php

namespace App\DataTransferObjects;

readonly class ClassicAnswerDto
{
    protected function __construct(
        public string $id,
        public string $title,
        public bool $isValid,
    ) {}

    public static function create(
        string $id,
        array $title,
        bool $isValid,
    ): static {
        return new static(
            $id,
            $title[config('services.quiz-api.preferred_lang')],
            $isValid,
        );
    }

    public static function fromArray(array $data): static
    {
        return self::create(
            id: $data['id'],
            title: $data['title'],
            isValid: (bool) $data['isValid']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isValid' => $this->isValid,
        ];
    }
}
