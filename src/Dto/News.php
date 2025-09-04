<?php

namespace App\Dto;

class News
{
    public function __construct(
        public ?string $uuid,
        public ?string $title,
        public ?string $description,
        public ?string $imagePath,
    ) {
    }
}
