<?php

namespace App\Controller;

use App\Repository\AdvertisementRepository;
use App\Repository\EventRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\OffsideCategoryRepository;
use App\Repository\PraxisCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumHomeController extends AbstractController
{
    #[Route('/forum/home', name: 'forum_home')]
    public function index(EventRepository $eventRepos, 
    AdvertisementRepository $advertisementRepos,
    OffsideCategoryRepository $offsideCategoryRepos,
    PraxisCategoryRepository $praxisCategoryRepos,
    JobCategoryRepository $jobCategoryRepos,): Response
    {        
        $offsideCategories = $offsideCategoryRepos->findAll();
        $praxisCategories = $praxisCategoryRepos->findAll();
        $jobCategories = $jobCategoryRepos->findAll();
        $advertisements = $advertisementRepos->findAll();
        $events = $eventRepos->findAll();
        return $this->render('forumHome/home.html.twig', [
            'advertisements' => $advertisements,
            'events' => $events,
            'offsideCategories' => $offsideCategories,
            'praxisCategories' => $praxisCategories,
            'jobCategories' => $jobCategories,
        ]);

    }
}
