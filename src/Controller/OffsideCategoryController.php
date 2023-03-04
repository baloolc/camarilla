<?php

namespace App\Controller;

use App\Entity\OffsideCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffsideCategoryController extends AbstractController
{
    #[IsGranted('ROLE_MEMBER')]
    #[Route('/offside/{slug}', name: 'offside_show')]
    public function showAdvertisement(?OffsideCategory $offsideCategory): Response
    {
        if (!$offsideCategory) {
            return $this->redirectToRoute('forum_home');
        }

        return $this->render('offside/show.html.twig', [
            'offsideCategory' => $offsideCategory,
        ]);
    }
}
