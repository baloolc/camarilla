<?php

namespace App\Controller;

use App\Entity\PraxisCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PraxisCategoryController extends AbstractController
{
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
