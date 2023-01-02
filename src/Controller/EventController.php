<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/home/forum', name: 'home_forum')]
    public function index(): Response
    {
        return $this->render('event/home_forum.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/event/{slug}', name: 'event_show')]
    public function show(): Response
    {
        return $this->render('event/show.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
