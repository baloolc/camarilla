<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProfilController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('profil/index.html.twig');
    }
}