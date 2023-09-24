<?php

namespace App\Controller;

use App\Entity\CharacterRequest;
use App\Form\CharacterRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CharacterRequestController extends AbstractController
{
    #[Route('/request', name: 'character_request')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        /** @var User  */
        $user = $this->getUser();
        
        $characterRequest = new CharacterRequest();
        $form = $this->createForm(CharacterRequestType::class, $characterRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $email = (new Email())
                ->from($user->getEmail())
                ->to($this->getParameter('mailer_story'))
                ->subject($user->getFirstname() . ' ' . $user->getLastname() . ' fait la demande d\'un nouveau personnage')
                ->html($this->renderView('email/email_character_request.html.twig', [
                    'characterRequest' => $characterRequest,
                    'user' => $user,
            ]));
            $mailer->send($email);
            $this->addFlash('success', 'Votre email est bien envoyé');
            return $this->redirectToRoute('home');
        }
        return $this->render('character_request/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
