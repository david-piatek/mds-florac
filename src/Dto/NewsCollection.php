<?php

namespace App\Dto;

class NewsCollection
{
    public function __construct(
        /**
         * @var News[]
         */
        public array $news = [],
    ) {
    }
}
