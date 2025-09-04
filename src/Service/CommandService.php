<?php

namespace App\Service;

use App\Dto\MedicalProfessionalCollection;
use App\Dto\NewsCollection;
use App\Dto\Office;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CommandService
{
    public function __construct(
        #[Autowire(param: 'kernel.project_dir')]
        private string $rootDir,
    ) {
    }

    private function write($path, $data)
    {
        file_put_contents(
            sprintf('%s/data/%s.json', $this->rootDir, $path),
            json_encode($data)
        );
    }

    public function writeOffice( $office)
    {
        $this->write('office', $office);
    }

    public function writeMedicalProfessionals(MedicalProfessionalCollection $medicalProfessionals)
    {
        $this->write('medical_professionals', $medicalProfessionals->medicalProfessionals);
    }

    public function writeNews(NewsCollection $news)
    {
        $this->write('news', $news->news);
    }
}
