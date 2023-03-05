<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    #[Route('/profil/{slug}', name: 'profil_index')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig');
    }
}