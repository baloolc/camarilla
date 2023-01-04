<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\InGameCategoryRepository;
use App\Repository\OffsideCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'forum_home')]
    public function index(InGameCategoryRepository $inGameCategoryRepo, OffsideCategoryRepository $offsideCategoryRepo, EventRepository $eventRepo): Response
    {
        
        
        /** @var User  */
        $user = $this->getUser();
        $character = $user->getCharacters();
        $events = $eventRepo->findAll();
        $offsideCategories = $offsideCategoryRepo->findAll();
        $inGameCategories = $inGameCategoryRepo->findAll();
        return $this->render('event/home.html.twig', [
            'event' => $events,
            'offsideCategories' => $offsideCategories,
            'inGameCategories' => $inGameCategories,
            'characters' => $character,

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
