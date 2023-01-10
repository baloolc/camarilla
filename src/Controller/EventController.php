<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'forum_home')]
    public function index(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        return $this->render('event/home.html.twig', [
            'event' => $events,
        ]);
    }

    #[Route('/event/{slug}', name: 'event_show')]
    public function show(): Response
    {
        return $this->render('event/show.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    public function deleteImage(Event $event)
    {
        
    }
}
