<?php

namespace App\DTOs;

readonly class ErrorData
{
    public function __construct(
        public string $title,
        public string $description,
        public string $level,
        public ?int   $userId = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            level: $data['level'],
            userId: $data['user_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'level' => $this->level,
            'user_id' => $this->userId,
        ];
    }
}
