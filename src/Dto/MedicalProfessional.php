<?php

namespace App\Dto;

class MedicalProfessional
{
    public function __construct(
        public ?string $uuid,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $placePosition,
        public ?string $job,
        public ?string $description,
        public ?string $imagePath,
    ) {
    }
}
