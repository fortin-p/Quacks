<?php

namespace App\Controller;

use App\Entity\Ducks;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/", name="duck_create")
     * @Route("/edit/{id}", name="edit_ducks")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function form(Ducks $duck = Null, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        if (!$duck) {
            $duck = new Ducks();
        }

        $form = $this->createFormBuilder($duck)
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',

                ]
            ])->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->add('duckname', TextType::class, [
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
            ->add('ProfilImage', TextType::class, [
                'attr' => [
                    'class' => 'form-control']
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($duck, $duck->getPassword());
            $duck->setPassword($password);

            $manager->persist($duck);
            $manager->flush();

            return $this->redirectToRoute('list_quack');
        }
        dump($duck);
        return $this->render('authentification/create.html.twig', [
            'formAuth' => $form->createView(),
            'editMode' => $duck->getId() !== Null,
        ]);
    }


}
