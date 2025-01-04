<?php

namespace App\DataTransferObjects;

readonly class ThemeDto
{
    protected function __construct(
        public string $code,
        public string $title,
    ) {}

    public static function create(
        string $code,
        string $title,
    ): static {
        return new static(...func_get_args());
    }

    public static function fromArray(array $data): static
    {
        return self::create(
            code: $data['code'],
            title: $data['title']
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'title' => $this->title,
        ];
    }
}
