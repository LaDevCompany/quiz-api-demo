<?php

namespace App\DataTransferObjects;

use App\Enums\QuestionType;
use Exception;
use Illuminate\Support\Collection;

readonly class QuestionDto
{
    protected function __construct(
        public string $id,
        public QuestionType $type,
        public string $title,
        public string $description,
        public int $difficulty,
        public ThemeDto $theme,
        public Collection|PatternAnswerDto $answers,
    ) {}

    public static function create(
        string $id,
        string $type,
        array $title,
        string $description,
        int $difficulty,
        array $theme,
        array $answers,
    ): static {
        return new static(
            $id,
            QuestionType::from($type),
            $title[config('services.quiz-api.preferred_lang')],
            $description,
            $difficulty,
            ThemeDto::fromArray($theme),
            self::getAnswers($type, collect($answers))
        );
    }

    public static function fromArray(array $data): static
    {
        return self::create(
            id: $data['id'],
            type: $data['type'],
            title: $data['title'],
            description: $data['description'] ?? '',
            difficulty: $data['difficulty'],
            theme: $data['theme'],
            answers: $data['answers'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'difficulty' => $this->difficulty,
            'theme' => $this->theme->toArray(),
            'answers' => $this->answers->toArray(),
        ];
    }

    protected static function getAnswers(string $type, Collection $answers): Collection|PatternAnswerDto
    {
        return match ($type) {
            QuestionType::Solo->value, QuestionType::Multi->value => $answers->map(fn (array $answer) => ClassicAnswerDto::fromArray($answer)),
            QuestionType::Pattern->value => PatternAnswerDto::fromArray($answers->toArray()),
            default => throw new Exception('Unknown question type'),
        };
    }
}
