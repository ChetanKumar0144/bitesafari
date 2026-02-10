<?php

namespace App\DTOs;
use Illuminate\Http\Request;

class CategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $slug = null,
        public readonly ?string $image = null,
        public readonly bool $status = true,
    ) {}

    public static function fromRequest(array $data, ?string $imagePath = null): self
    {
        return new self(
            name: $data['name'],
            slug: \Illuminate\Support\Str::slug($data['name']),
            image: $imagePath,
            status: $data['status'] ?? true
        );
    }
}
