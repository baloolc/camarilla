<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffsideTopicController extends AbstractController
{
    #[Route('/offside/topic/{slug}', name: 'show_offside_topic')]
    public function show(): Response
    {
        return $this->render('offside_topic/show.html.twig', [
            'controller_name' => 'OffsideTopicController',
        ]);
    }
}
