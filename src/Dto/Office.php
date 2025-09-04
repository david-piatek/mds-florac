<?php

namespace App\Dto;

class Office
{
    public function __construct(
        public ?string $uuid,
        public ?string $title,
        public ?string $history,
        public ?string $description,
        public ?string $imagePath,
    ) {
    }
}
