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

    public static function fromRequest(Request $request, ?string $imagePath = null): self
    {
        return new self(
            name: $request->validated('name') ?? $request->name,
            slug: \Illuminate\Support\Str::slug($request->name),
            image: $imagePath,
            status: $request->status ?? true
        );
    }
}
