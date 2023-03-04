<?php

namespace App\Controller;

use App\Entity\JobCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobCategoryController extends AbstractController
{
    #[IsGranted('ROLE_MEMBER')]
    #[Route('/job/{slug}', name: 'job_show')]
    public function showAdvertisement(?JobCategory $jobCategory): Response
    {
        if (!$jobCategory) {
            return $this->redirectToRoute('forum_home');
        }

        return $this->render('job/show.html.twig', [
            'jobCategory' => $jobCategory,
        ]);
    }
}
