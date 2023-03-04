<?php

namespace App\Controller;

use App\Entity\PraxisCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PraxisCategoryController extends AbstractController
{
    #[IsGranted('ROLE_MEMBER')]
    #[Route('/praxis/{slug}', name: 'praxis_show')]
    public function showAdvertisement(?PraxisCategory $praxisCategory): Response
    {
        if (!$praxisCategory) {
            return $this->redirectToRoute('forum_home');
        }

        return $this->render('praxis/show.html.twig', [
            'praxisCategory' => $praxisCategory,
        ]);
    }
}
