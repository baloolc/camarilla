<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Entity\Event;
use App\Entity\User;
use App\Form\EventType;
use App\Repository\AdvertisementRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'forum_home')]
    public function index(EventRepository $eventRepo, AdvertisementRepository $advertisementRepos): Response
    {
        $advertisements = $advertisementRepos->findAll();
        $events = $eventRepo->findAll();
        return $this->render('event/home.html.twig', [
            'advertisements' => $advertisements,
            'events' => $events,
        ]);
    }

    #[Route('/event/{slug}', name: 'event_show')]
    public function showEvent(?Event $event, Request $request, EventRepository $eventRepo): Response
    {
        $nbParticipant = $event->getNbParticipant();
        $nbMaybe = $event->getNbMaybe();
        $nbNoParticipant = $event->getNbNoParticipant();

        if (!$event) {
            return $this->redirectToRoute('forum_home');
        }

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($event->getStatus() === 'Je participe') {
                $this->addFlash('success', 'Vous êtes inscrit sur l\'évènement');
                $nombreParticipant = $nbParticipant + 1;
                $event->setNbParticipant($nombreParticipant);
                $eventRepo->save($event, $flush = true);
            }
            if ($event->getStatus() === 'Peut être') {
                $nombreMaybe = $nbMaybe + 1;
                $event->setNbMaybe($nombreMaybe);
                $eventRepo->save($event, $flush = true);
            }
            if ($event->getStatus() === 'Je ne participe pas') {
                $nombreNoParticipant = $nbNoParticipant + 1;
                $event->setNbNoParticipant($nombreNoParticipant);
                $eventRepo->save($event, $flush = true);
            } 
            return $this->redirectToRoute('forum_home', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('event/show.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/advertisement/{slug}', name: 'advertisement_show')]
    public function showAdvertisement(?Advertisement $advertisement): Response
    {
        if (!$advertisement) {
            return $this->redirectToRoute('forum_home');
        }

        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }
}
