<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\MailerService;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param MailerService $mailerservice
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(Request $request, MailerService $mailerservice)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mailerservice->send(
                "Nouveau message",
                "pef@test.fr",
                'dev@campus.fr',
                "Email/contact.html.twig",
                [
                    "name" => $data['name'],
                    "message" => $data['message'],
                    "email" => $data['email']
                ]
            );
            $this->addFlash('message', 'le message à été envoyé');
            dd($data);
        }
        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
