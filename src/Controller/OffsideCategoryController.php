<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffsideCategoryController extends AbstractController
{
    #[Route('/offside/category/{slug}', name: 'show_offside_category')]
    public function show(): Response
    {
        return $this->render('offside_category/show.html.twig', [
            'controller_name' => 'OffsideCategoryController',
        ]);
    }
}
