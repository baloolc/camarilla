<?php

namespace App\Controller\Admin;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserAdminController extends AbstractController
{
    /* public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->redirectToRoute('/user/account-confirmation/' . $this->email);
    }

    #[Route('/user/account-confirmation/{email}', name: 'account_confirmation', methods: ['GET'])]
    public function sendConfirmationAccountActivated(MailerInterface $mailer, string $email): void
    {

        $emailToSend = (new TemplatedEmail())
                ->from('Bureauacionna@gmail.com')
                ->to($email)
                ->subject('Un compte d\'un utilisateur est en attente d\'activation')
                ->htmlTemplate('email/activation_email_user.html.twig');

                $mailer->send($emailToSend);
    }
 */
  /*   public function sendEmail($email)
    {
        return $this->redirectToRoute('/user/account-confirmation/' . $email);
    } */
}