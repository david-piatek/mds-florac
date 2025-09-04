<?php

namespace App\Controller;

use App\Dto\MedicalProfessional;
use App\Dto\MedicalProfessionalCollection;
use App\Dto\News;
use App\Dto\NewsCollection;
use App\Dto\Office;
use App\Form\Type\MedicalProfessionalCollectionType;
use App\Form\Type\NewsCollectionType;
use App\Form\Type\OfficeType;
use App\Service\CommandService;
use App\Service\QueryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    // https://symfony.com/doc/current/controller/upload_file.html

    public function __construct(
        #[Autowire(param: 'kernel.project_dir')]
        private string $rootDir,
    ) {
    }

    #[Route('/admin', name: 'admin_homepage')]
    public function index(
    ): Response {
        return $this->redirectToRoute('admin_office');

    }

    #[Route('/admin/office', name: 'admin_office')]
    public function office(
        QueryService $queryService,
        CommandService $commandService,
        Request $request,
    ): Response {
        $form = $this->createForm(OfficeType::class, $queryService->getOffice($queryService->isPreview()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Office $office
             */
            $office = $form->getData();
            $commandService->writeOffice($office);

            return $this->redirectToRoute('admin_office');
        }

        return $this->render('admin/office.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/medical-professional', name: 'admin_medical_professional')]
    public function medicalProfessionals(
        QueryService $queryService,

        CommandService $commandService,
        Request $request,
    ): Response {
        $professionals = array_map(
            fn ($item) => new MedicalProfessional(
                $item['uuid'] ?? uniqid(),
                    $item['firstName'] ?? null,
                    $item['lastName'] ?? null,
                    $item['placePosition'] ?? null,
                    $item['job'] ?? null,
                    $item['description'] ?? null,
                    $item['imagePath'] ?? null,
            ),
            $queryService->getMedicalProfessionals($queryService->isPreview())
        );
        $form = $this->createForm(MedicalProfessionalCollectionType::class, new MedicalProfessionalCollection($professionals));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var MedicalProfessionalCollection $medicalProfessionalCollection
             */
            $medicalProfessionalCollection = $form->getData();
            $commandService->writeMedicalProfessionals($medicalProfessionalCollection);

            return $this->redirectToRoute('admin_medical_professional');
        }

        return $this->render('admin/medical_professionnals.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/news', name: 'admin_news')]
    public function news(
        QueryService $queryService,
        CommandService $commandService,
        Request $request,
    ): Response {
        $form = $this->createForm(NewsCollectionType::class, new NewsCollection(array_map(
            fn (array $item) => new News(
                $item['uuid'] ?? uniqid(),
                $item['title'] ?? null,
                $item['description'] ?? null,
                $item['imagePath'] ?? null,
            ),
            $queryService->getNews($queryService->isPreview())
        )));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var NewsCollection $news
             */
            $news = $form->getData();
            $commandService->writeNews($news);

            return $this->redirectToRoute('admin_news');
        }

        return $this->render('admin/news.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
