<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InGameTopicController extends AbstractController
{
    #[Route('/in/game/topic/{slug}', name: 'show_in_game_topic')]
    public function show(): Response
    {
        return $this->render('in_game_topic/show.html.twig', [
            'controller_name' => 'InGameTopicController',
        ]);
    }
}
