<?php
namespace App\Services;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Twig\Environment;


class MailerService
{

    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $template
     * @param array $parameter
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function send(string $subject, string $from, string $to, string $template, array $parameters): void
    {
        //On envoie le mail
        $email = (new Email())
            // expediteur
            ->from($from)
            //destinataire
            ->to($to)
            ->subject($subject)
            ->html($this->twig->render(
                $template, $parameters)
            );
        //on envoie
        $this->mailer->send($email);
    }
}
