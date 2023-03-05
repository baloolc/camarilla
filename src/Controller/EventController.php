<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\OffsideCategoryRepository;
use App\Repository\PraxisCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[IsGranted('ROLE_MEMBER')]
    #[Route('/event/{slug}', name: 'event_show')]
    public function showEvent(?Event $event,
    Request $request,
    EventRepository $eventRepo,
    OffsideCategoryRepository $offsideCategoryRepos,
    PraxisCategoryRepository $praxisCategoryRepos,
    JobCategoryRepository $jobCategoryRepos,): Response
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

        $offsideCategories = $offsideCategoryRepos->findAll();
        $praxisCategories = $praxisCategoryRepos->findAll();
        $jobCategories = $jobCategoryRepos->findAll();

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'offsideCategories' => $offsideCategories,
            'praxisCategories' => $praxisCategories,
            'jobCategories' => $jobCategories,
        ]);
    }
}
