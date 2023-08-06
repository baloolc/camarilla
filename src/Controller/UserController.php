<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\UserMedia;
use App\Form\UserMediaType;
use App\Form\UserType;
use App\Repository\UserMediaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class UserController extends AbstractController
{
    #[Route('/profil/modifier-profil/{slug}', name: 'user_profil_edit',  methods: ['GET', 'POST'])]
    public function editUserProfil(Request $request, UserRepository $userRepository, UserMediaRepository $userMediaRepository): Response
    {

        /** @var User  */
        $user = $this->getUser();
        if (!$user instanceof UserInterface) {
            return $this->redirectToRoute('login');
        } else {
            $media = $user->getUserMedia();

            if ($media === null) {
                $media = new UserMedia();
                $media->setUser($user);
            }
        }


        $mediaForm = $this->createForm(UserMediaType::class, $media);
        $mediaForm->handleRequest($request);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $userRepository->save($user, true);
            $this->addFlash('success', 'Vos identifiants ont bien été modifié !');


            return $this->redirectToRoute('user_profil_edit', ['slug' => $user->getSlug()], Response::HTTP_SEE_OTHER);
        }

        if ($mediaForm->isSubmitted() && $mediaForm->isValid()) {

            $uploadedFile = $mediaForm['avatar']->getData();

            if ($uploadedFile) {
                $targetDirectory = $this->getParameter('uploads_user_avatar');
                $newFilename = 'avatar.' . $uploadedFile->getClientOriginalExtension();
 
                $oldFilename = $media->getAvatar();
                if ($oldFilename && file_exists($targetDirectory . '/' . $oldFilename)) {
                    unlink($targetDirectory . '/' . $oldFilename);
                }

                $uploadedFile->move($targetDirectory, $newFilename);
                $media->setAvatar($newFilename);
                $userMediaRepository->save($media, true);
                $this->addFlash('success', 'Votre avatar a bien été modifié !');
            }

            return $this->redirectToRoute('user_profil_edit', ['slug' => $user->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'mediaForm' => $mediaForm->createView(),
        ]);
    }
}
