<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfilController extends AbstractController
{

    #[Route('/profil', name: 'profil_home')]
    public function index(): Response
    {
        /** @var User  */
        $user = $this->getUser();
        $characters = $user->getCharacters();
        $media = $user->getUserMedia();

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'characters' => $characters,
            'media'=> $media,
        ]);
    }
}