<?php

namespace App\Dto;

class MedicalProfessionalCollection
{
    public function __construct(
        /**
         * @var MedicalProfessional[]
         */
        public array $medicalProfessionals = [],
    ) {
    }
}
