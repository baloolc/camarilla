<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PresentationRepository $presentationRepo): Response
    {
        $presentations = $presentationRepo->findAll();
        return $this->render('home/index.html.twig', [
            'presentations' => $presentations,
        ]);
    }
}
