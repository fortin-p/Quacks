<?php

namespace App\Controller;

use App\Entity\Ducks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification", name="authentification")
     */
    public function index(): Response
    {
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    /**
     * @Route("/authentification/new", name="duck_create")
     */
    public function createDuck(Request $request, EntityManagerInterface $manager)
    {
        $duck = new Ducks();
        $form = $this->createFormBuilder($duck)
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->add('DuckName', TextType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($duck);
            $manager->flush();

            return $this->redirectToRoute('list_quack');
        }
        dump($duck);
        return $this->render('authentification/create.html.twig', [
            'formAuth' => $form->createView(),
        ]);
    }

    /**
     * @Route("/authentification/login", name="duck_login")
     */
    public function loginDuck()
    {
        return $this->render('authentification/login.html.twig');
    }
}
