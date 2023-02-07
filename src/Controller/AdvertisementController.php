<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Repository\JobCategoryRepository;
use App\Repository\OffsideCategoryRepository;
use App\Repository\PraxisCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertisementController extends AbstractController
{
    #[Route('/advertisement/{slug}', name: 'advertisement_show')]
    public function showAdvertisement(?Advertisement $advertisement, 
    OffsideCategoryRepository $offsideCategoryRepos,
    PraxisCategoryRepository $praxisCategoryRepos,
    JobCategoryRepository $jobCategoryRepos,): Response
    {
        if (!$advertisement) {
            return $this->redirectToRoute('forum_home');
        }

        $offsideCategories = $offsideCategoryRepos->findAll();
        $praxisCategories = $praxisCategoryRepos->findAll();
        $jobCategories = $jobCategoryRepos->findAll();

        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $advertisement,
            'offsideCategories' => $offsideCategories,
            'praxisCategories' => $praxisCategories,
            'jobCategories' => $jobCategories,
        ]);
    }
}
