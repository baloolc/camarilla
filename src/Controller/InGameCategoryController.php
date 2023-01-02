<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InGameCategoryController extends AbstractController
{
    #[Route('/in/game/category/{slug}', name: 'show_in_game_category')]
    public function show(): Response
    {
        return $this->render('in_game_category/show.html.twig', [
            'controller_name' => 'InGameCategoryController',
        ]);
    }
}
