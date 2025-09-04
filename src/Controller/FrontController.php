<?php

namespace App\Controller;

use App\Service\QueryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home(
        QueryService $queryService,
    ): Response {
        return $this->render('front/homepage.html.twig', [
            'office' => $queryService->getOffice($queryService->isPreview()),
            'medicalProfessionals' => $queryService->getMedicalProfessionals($queryService->isPreview()),
            'news' => $queryService->getNews($queryService->isPreview()),
            'isPreview' => $queryService->isPreview(),
        ]);
    }

    #[Route('/office', name: 'office')]
    public function office(
        QueryService $queryService,
    ): Response {
        if ($queryService->isPreview()){
            dd($queryService->getOffice($queryService->isPreview()));
        }
        return $this->render('front/office.html.twig', [
            'office' => $queryService->getOffice($queryService->isPreview()),
            'isPreview' => $queryService->isPreview(),
        ]);
    }

    #[Route('/medical-professional', name: 'medical_professional')]
    public function medicalProfessional(
        QueryService $queryService,
    ): Response {
        return $this->render('front/medical_professionals.html.twig', [
            'medicalProfessionals' => $queryService->getMedicalProfessionals($queryService->isPreview()),
            'isPreview' => $queryService->isPreview(),
        ]);
    }

    #[Route('/news', name: 'news')]
    public function news(
        QueryService $queryService,
    ): Response {
        return $this->render('front/news.html.twig', [
            'news' => $queryService->getNews($queryService->isPreview()),
            'isPreview' => $queryService->isPreview(),
        ]);
    }

    #[Route('/welcome', name: 'welcome')]
    public function welcome(
        QueryService $queryService,
    ): Response {
        return $this->render('front/welcome.html.twig', [
            'isPreview' => $queryService,
        ]);
    }
}
