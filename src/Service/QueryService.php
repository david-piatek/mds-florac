<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;

class QueryService
{
    public function __construct(
        #[Autowire(param: 'kernel.project_dir')]
        private string $rootDir,
    ) {
    }

    public function isPreview(): bool
    {
        $request = Request::createFromGlobals();

        return 'true' === $request->query->get('isPreview') ? true : false;
    }

    private function decode(string $path, bool $isPreview)
    {
        $jsonNews = file_get_contents(
            sprintf(
                '%s/%s/%s.json',
                $this->rootDir,
                $isPreview ? 'tmp/data' : 'data' ,
                $path
            )
        );

        return json_decode($jsonNews, true);
    }

    public function getOffice(bool $isPreview = false)
    {
        return $this->decode('office', $isPreview);
    }

    public function getMedicalProfessionals(bool $isPreview = false)
    {
        return $this->decode('medical_professionals', $isPreview);
    }

    public function getNews(bool $isPreview = false)
    {
        return $this->decode('news', $isPreview);
    }
}
