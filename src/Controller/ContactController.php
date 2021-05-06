<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            //On envoie le mail
            $message = (new Email())
                // expediteur
            ->from($contact['email'])
                //destinataire
                ->to('pierre-elie.campus@le-campus-numerique.fr')
                ->subject(
                    $this->renderView(
                        'email/contact.html.twig',compact('contact')
                    )
                )
                ->text('test')
                ->html('<p>See Twig integration for better HTML integration!</p>');
                //on envoie
            $mailer->send($message);
            $this->addFlash('message', 'le message à été envoyé');
           dd($contact);
        }
        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
